<?php

// https://github.com/KRypt0nn/VKAPI
// https://github.com/slmatthew/senses-engine/blob/master/docs/helpers/template.md
// https://github.com/VKCOM/vk-php-sdk

require_once __DIR__ . '/vendor/autoload.php';

use VKSdk\Core\Callback\LongPoll\VKLongPoll;
use VKSdk\Exceptions\VkSdkException;
use VKSdk\VKApi;

$vk = new VKApi([
    'access_token' => 'b1383287f270b9999c6c5119eefe3600b368a49f010bfa20eacd277e0a1e9fad96ce2b7a3c2ce472dee6c'
]);

echo '<pre>';

class CallbackBot extends VKLongPoll {
    private const CONFIRMATION = '40dd1432';

    function confirmation(int $group_id, ?string $secret) {
        echo self::CONFIRMATION;
    }

    public function messageNew(int $group_id, array $data) {
        var_dump($group_id);
    }

    public function wallPostNew(int $group_id, array $data) {
        var_dump($data);
        $this->ok();
    }
}

try {
    $callback = new CallbackBot([
        'access_token' => 'ebc8b043d54c43506a616de4595603a855da917155fbe08829e0e9765288cbb6253da1815230f05dc38be',
        'group_id' => '154235901'
    ]);

    $callback->listener(function ($data){
        var_dump($data);
    });
} catch (VkSdkException $e) {
    var_dump($e->getMessage());
}