<?php

namespace VKSdk\Core\Curl;

class HttpResponse {

    private $responseCode = 0;
    private $response;

    public function __construct(array $data) {
        $this->response = $data['response'] ?? null;
        $this->responseCode = $data['response_code'] ?? null;
    }

    /**
     * Возвращает код ответа
     *
     * @return int - код ответа
     */
    public function responseCode(): int {
        return $this->responseCode;
    }

    public function toString(): string {
        return $this->response;
    }

    public function toJson(): array {
        $body = json_decode($this->response, true);
        if ($body === null || !is_array($body)) {
            $body = [];
        }

        return $body;
    }

}