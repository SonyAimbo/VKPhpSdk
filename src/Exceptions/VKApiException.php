<?php

namespace VKSdk\Exceptions;

use Throwable;

class VKApiException extends \Exception {

    private $error_code;
    private $error_msg;

    public function __construct(int $error_code, string $message, Throwable $previous = null) {
        $this->error_code = $error_code;
        $this->error_msg = $message;

        parent::__construct($message, $error_code, $previous);
    }

    /**
     * @return int
     */
    public function getErrorCode(): int {
        return $this->error_code;
    }

    /**
     * @return string
     */
    public function getErrorMsg(): string {
        return $this->error_msg;
    }



}