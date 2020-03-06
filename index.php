<?php

require_once __DIR__ . '/vendor/autoload.php';

use VKSdk\VKApi;
use VKSdk\Core\Callback\Server\VKCallback;

$vk = new VKApi([
    'access_token' => 'b1383287f270b9999c6c5119eefe3600b368a49f010bfa20eacd277e0a1e9fad96ce2b7a3c2ce472dee6c'
]);

class CallbackBot extends VKCallback {
    private const CONFIRMATION = '40dd1432';

    function confirmation(int $group_id, ?string $secret) {
        echo self::CONFIRMATION;
    }

    public function messageNew(int $group_id, string $text, array $data) {
        var_dump($text);
    }

}

$callback = new CallbackBot();