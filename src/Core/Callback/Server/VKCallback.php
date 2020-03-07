<?php

namespace VKSdk\Core\Callback\Server;

use VKSdk\Core\Callback\VKCallbackCore;

abstract class VKCallback extends VKCallbackCore {
    private const TYPE = 'type';
    private const CONFIRMATION = 'confirmation';
    private const GROUP_ID = 'group_id';
    private const SECRET = 'secret';

    public function __construct() {
        //$data = json_decode(file_get_contents('php://input'), true);
        $data = json_decode('{
    "type": "wall_post_new",
    "object": {
        "id": 696,
        "from_id": -154235901,
        "owner_id": -154235901,
        "date": 1583607944,
        "marked_as_ads": 0,
        "post_type": "post",
        "text": "saas",
        "can_edit": 1,
        "created_by": 177076922,
        "can_delete": 1,
        "comments": {
            "count": 0
        },
        "is_favorite": false
    },
    "group_id": 154235901,
    "event_id": "1190288e1ee9b611268b644f36291e3ea6103e02",
    "secret": "mnNEGlTSI9ohjqea"
}', true);
        if(isset($data[self::TYPE])) {
            if ($data[self::TYPE] == self::CONFIRMATION) {
                $this->confirmation($data[self::GROUP_ID], $data[self::SECRET]);
            } else {
                parent::parser($data);
            }
        }
    }

    abstract function confirmation(int $group_id, ?string $secret);

}