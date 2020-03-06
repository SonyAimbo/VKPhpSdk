<?php

namespace VKSdk\Core;

use VKSdk\Core\Curl\HttpClient;
use VKSdk\Core\Curl\HttpException;
use VKSdk\Core\Curl\HttpResponse;
use VKSdk\Exceptions\VKApiException;
use VKSdk\Exceptions\VkSdkException;

class VKCore {
    private const DEF_V = 5.103;
    private const DEF_URL = "https://api.vk.com/method/";
    private const KEY_TOKEN = 'access_token';
    private const KEY_V = 'v';
    private const KEY_ERROR = 'error';
    private const KEY_ERROR_MSG = 'error_msg';
    private const KEY_ERROR_CODE = 'error_code';


    protected const HTTP_STATUS_CODE_OK = 200;
    protected const CONNECTION_TIMEOUT = 10;

    /**
     * @var HttpClient
     */
    private $http;

    /**
     * @var string
     */
    private $access_token;

    /**
     * @var string
     */
    private $v;

    /**
     * VKCore constructor.
     * @param array $params
     */
    public function __construct(array $params) {
        $this->http = new HttpClient(self::CONNECTION_TIMEOUT);
        $this->access_token = isset($params['access_token']) ? $params['access_token'] : null;
        $this->v = isset($params['v']) ? $params['v'] : self::DEF_V;
    }

    /**
     * @param string $method
     * @param array $params
     * @return array
     * @throws VKApiException
     * @throws VkSdkException
     */
    public function call(string $method, array $params) {
        $params = $this->formatParams($params);

        $params[self::KEY_TOKEN] = isset($params[self::KEY_TOKEN]) ? $params[self::KEY_TOKEN] : $this->access_token;
        $params[self::KEY_V] = isset($params[self::KEY_V]) ? $params[self::KEY_V] : self::DEF_V;

        if(empty($params[self::KEY_TOKEN])) {
            throw new VkSdkException('access token not specified');
        }

        try {
            $response = $this->http->post(self::DEF_URL . $method, $params);
        } catch (HttpException $e) {
            throw new VkSdkException($e);
        }

        return self::parseJson($response);
    }

    /**
     * Функция форматирует параметры передаваемые с запросом.
     * Например массив разобьем через запятую.
     * @param array $params
     *
     * @return array
     */
    private function formatParams(array $params): array {
        foreach ($params as $k => $v) {
            if(is_array($v)) {
                $params[$k] = implode(',', $v);
            } else if(is_bool($v)) {
                $params[$k] = $v ? 1 : 0;
            }
        }

        return $params;
    }

    /**
     * @param HttpResponse $response
     * @return array
     * @throws VKApiException
     * @throws VkSdkException
     */
    private function parseJson(HttpResponse $response):array {
        if((int) $response->responseCode() !== self::HTTP_STATUS_CODE_OK) {
            throw new VkSdkException("Invalid Http Status: {$response->responseCode()}");
        }

        $json = $response->toJson();

        if(isset($json['error'])) {
            $error_code = $json[self::KEY_ERROR][self::KEY_ERROR_CODE];
            $error_msg = $json[self::KEY_ERROR][self::KEY_ERROR_MSG];

            if((int) $error_code !== 14) {
                throw new VKApiException($error_code, $error_msg);
            }
        }

        return $json;
    }


}