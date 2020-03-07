<?php

namespace VKSdk\Core\Callback\LongPoll;

use VKSdk\Core\VKCore;

class VKLongPoll {

    private $http;

    public function __construct($params) {
        $this->http = new VKCore($params);
    }

    public function getLongPollServer() {

    }

}