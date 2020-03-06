<?php


namespace VKSdk\Core\Callback;

use Throwable;

class VKCallbackException extends \Exception {

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}