<?php

namespace VKSdk\Core\Curl;

class HttpClient {

    private $gzip = true;
    private $curl_init;

    function __construct(int $connection_timeout = 80, int $curl_timeout_ms = 2000) {
        $this->curl_init = array(
            CURLOPT_CONNECTTIMEOUT => $connection_timeout,
            CURLOPT_TIMEOUT_MS => $curl_timeout_ms,
            CURLOPT_RETURNTRANSFER => true,
        );
    }

    /**
     * @param string $url
     * @param array|null $data
     * @return HttpResponse
     * @throws HttpException
     */
    public function post(string $url, ?array $data = null): HttpResponse {
        return $this->call($url, array(
            CURLOPT_POST       => true,
            CURLOPT_POSTFIELDS => $data
        ));
    }

    /**
     * @param string $url
     * @param array $data
     * @return HttpResponse
     * @throws HttpException
     */
    public function get(string $url, array $data = []): HttpResponse {
        return $this->call($url . "?" . http_build_query($data), array());
    }

    /**
     * Функция для отправки запросов
     *
     * @param string $url - Ссылка
     * @param array $data - Данные GET или POST запроса
     * @return HttpResponse - Возвращает тело ответа
     * @throws HttpException
     */
    private function call(string $url, ?array $data): HttpResponse {
        $response = array();

        $ch = curl_init($url);

        if($this->gzip) {
            $this->curl_init[CURLOPT_ENCODING] = "deflate,gzip,br";
        }

        curl_setopt_array($ch, $this->curl_init + $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $response['response'] = curl_exec($ch);
        $response['response_code'] = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $error_code = curl_errno($ch);
        $error = curl_error($ch);

        if ($error || $error_code) {
            $error_msg = "Failed CURL Request. Error: {$error_code}";
            $error_msg .= $error ?? "";

            throw new HttpException($error_msg, $error_code);
        }

        return new HttpResponse($response);
    }

    /**
     * Включить/отключить gzip кодировку
     *
     * @param bool $enable
     */
    public function gzip(bool $enable = true) {
        $this->gzip = $enable;
    }
}