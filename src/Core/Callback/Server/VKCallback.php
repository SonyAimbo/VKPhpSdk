<?php

namespace VKSdk\Core\Callback\Server;

use VKSdk\Core\Callback\VKCallbackCore;

abstract class VKCallback extends VKCallbackCore {
    private const TYPE = 'type';
    private const CONFIRMATION = 'confirmation';
    private const GROUP_ID = 'group_id';
    private const SECRET = 'secret';

    public function __construct() {
        $data = json_decode(file_get_contents('php://input'), true);

        if(isset($data[self::TYPE])) {
            if ($data[self::TYPE] == self::CONFIRMATION) {
                $this->confirmation($data[self::GROUP_ID], $data[self::SECRET]);
            } else {
                parent::parser($data);
            }
        } else {
            trigger_error("Server did not return data", 0);
        }
    }

    abstract function confirmation(int $group_id, ?string $secret);

}