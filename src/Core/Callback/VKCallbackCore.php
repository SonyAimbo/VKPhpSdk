<?php

namespace VKSdk\Core\Callback;

abstract class VKCallbackCore {

    /* MESSAGE */
    public function messageNew(int $group_id, array $data) {}
    public function messageReply(int $group_id, array $data) {}
    public function messageEdit(int $group_id, array $data) {}
    public function messageAllow(int $group_id, array $data) {}
    public function messageDeny(int $group_id, array $data) {}

    /* PHOTOS */
    public function photoNew(int $group_id, array $data) {}
    public function photoCommentNew(int $group_id, array $data) {}
    public function photoCommentEdit(int $group_id, array $data) {}
    public function photoCommentRestore(int $group_id, array $data) {}
    public function photoCommentDelete(int $group_id, array $data) {}

    /* AUDIO */
    public function audioNew(int $group_id, array $data) {}

    /* VIDEO */
    public function videoNew(int $group_id, array $data) {}
    public function videoCommentNew(int $group_id, array $data) {}
    public function videoCommentEdit(int $group_id, array $data) {}
    public function videoCommentRestore(int $group_id, array $data) {}
    public function videoCommentDelete(int $group_id, array $data) {}

    /* WALL */
    public function wallPostNew(int $group_id, array $data) {}
    public function wallRepost(int $group_id, array $data) {}
    public function wallReplyNew(int $group_id, array $data) {}
    public function wallReplyEdit(int $group_id, array $data) {}
    public function wallReplyRestore(int $group_id, array $data) {}
    public function wallReplyDelete(int $group_id, array $data) {}

    /* BOARD */
    public function boardPostNew(int $group_id, array $data) {}
    public function boardPostEdit(int $group_id, array $data) {}
    public function boardPostRestore(int $group_id, array $data) {}
    public function boardPostDelete(int $group_id, array $data) {}

    /* MARKET */
    public function marketCommentNew(int $group_id, array $data) {}
    public function marketCommentEdit(int $group_id, array $data) {}
    public function marketCommentRestore(int $group_id, array $data) {}
    public function marketCommentDelete(int $group_id, array $data) {}

    /* OTHER */
    public function groupLeave(int $group_id, array $data) {}
    public function groupJoin(int $group_id, array $data) {}
    public function userBlock(int $group_id, array $data) {}
    public function userUnblock(int $group_id, array $data) {}
    public function pollVoteNew(int $group_id, array $data) {}
    public function groupOfficersEdit (int $group_id, array $data) {}
    public function groupChangeSettings (int $group_id, array $data) {}
    public function groupChangePhoto(int $group_id, array $data) {}
    public function vkpayTransaction(int $group_id, array $data) {}
    public function appPayload (int $group_id, array $data) {}

    protected function parser(array $json) {
        $type = $json['type'];
        $words = explode('_', $type);
        $func = '';

        foreach ($words as $val) {
            $func .= ucfirst($val);
        }

        $func = lcfirst($func);

        if(method_exists(get_called_class(), $func)) {
            call_user_func_array(array($this, $func), array($json['group_id'], $json));
        } else {
            $this->ok();
        }
    }

    public function ok() {
        set_time_limit(0);
        ini_set('display_errors', 'Off');

        // Nginx
        if (is_callable('fastcgi_finish_request')) {
            session_write_close();
            fastcgi_finish_request();
            return True;
        }
        // Apache
        ignore_user_abort(true);

        ob_start();
        header("HTTP/1.1 200 OK");
        header('Content-Encoding: none');
        header('Content-Length: 2');
        header('Connection: close');
        echo 'ok';
        ob_end_flush();
        flush();
        return True;
    }

}