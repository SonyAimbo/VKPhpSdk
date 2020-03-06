<?php

namespace VKSdk;

use \VKSdk\Core\VKCore;

class VKApi extends VKCore {

    public function __construct(array $params) {
        parent::__construct($params);
    }

    public static function getCallbackData() {
        return json_decode(file_get_contents('php://input'), true);
    }

}