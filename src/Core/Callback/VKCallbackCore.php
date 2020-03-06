<?php

namespace VKSdk\Core\Callback;

abstract class VKCallbackCore {

    private const GROUP_ID = 'group_id';
    private const OBJECT = 'object';
    private const MESSAGE = 'message';
    private const TEXT = 'text';
    
    /* MESSAGE */
    public function messageNew(int $group_id, string $text, array $data) {}
    public function messageReply(int $group_id, string $text, array $data) {}
    public function messageEdit(int $group_id, string $text, array $data) {}
    public function messageAllow(int $group_id, array $data) {}
    public function messageDeny(int $group_id, array $data) {}

    /* PHOTOS */
    public function photoNew(int $group_id, array $data) {}
    public function photoCommentNew(int $group_id, string $text, array $data) {}
    public function photoCommentEdit(int $group_id, string $text, array $data) {}
    public function photoCommentRestore(int $group_id, string $text, array $data) {}
    public function photoCommentDelete(int $group_id, array $data) {}

    /* AUDIO */
    public function audioNew(int $group_id, array $data) {}

    /* VIDEO */
    public function videoNew(int $group_id, array $data) {}
    public function videoCommentNew(int $group_id, string $text, array $data) {}
    public function videoCommentEdit(int $group_id, string $text, array $data) {}
    public function videoCommentRestore(int $group_id, string $text, array $data) {}
    public function videoCommentDelete(int $group_id, array $data) {}

    /* WALL */
    public function wallPostNew(int $group_id, string $text, array $data) {}
    public function wallRepost(int $group_id, string $text, array $data) {}
    public function wallReplyNew(int $group_id, string $text, array $data) {}
    public function wallReplyEdit(int $group_id, string $text, array $data) {}
    public function wallReplyRestore(int $group_id, string $text, array $data) {}
    public function wallReplyDelete(int $group_id, array $data) {}

    /* BOARD */
    public function boardPostNew(int $group_id, string $text, array $data) {}
    public function boardPostEdit(int $group_id, string $text, array $data) {}
    public function boardPostRestore(int $group_id, string $text, array $data) {}
    public function boardPostDelete(int $group_id, array $data) {}

    /* MARKET */
    public function marketCommentNew(int $group_id, string $text, array $data) {}
    public function marketCommentEdit(int $group_id, string $text, array $data) {}
    public function marketCommentRestore(int $group_id, string $text, array $data) {}
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
        switch ($json['type']) {
            case 'message_new':
                $this->messageNew($json[self::GROUP_ID], $json[self::OBJECT][self::MESSAGE][self::TEXT], $json);
                break;
            case 'message_reply':
                $this->messageReply($json[self::GROUP_ID], $json[self::OBJECT][self::MESSAGE][self::TEXT], $json);
                break;
            case 'message_edit':
                $this->messageEdit($json[self::GROUP_ID], $json[self::OBJECT][self::MESSAGE][self::TEXT], $json);
                break;
            case 'message_allow':
                $this->messageAllow($json[self::GROUP_ID], $json);
                break;
            case 'message_deny':
                $this->messageDeny($json[self::GROUP_ID], $json);
                break;
            case 'photo_new':
                $this->photoNew($json[self::GROUP_ID], $json);
                break;
            case 'photo_comment_new':
                $this->photoCommentNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'photo_comment_edit':
                $this->photoCommentEdit($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'photo_comment_restore':
                $this->photoCommentRestore($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'photo_comment_delete':
                $this->photoCommentDelete($json[self::GROUP_ID], $json);
                break;
            case 'audio_new':
                $this->audioNew($json[self::GROUP_ID], $json);
                break;
            case 'video_new':
                $this->videoNew($json[self::GROUP_ID], $json);
                break;
            case 'video_comment_new':
                $this->videoCommentNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'video_comment_edit':
                $this->videoCommentEdit($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'video_comment_restore':
                $this->videoCommentRestore($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'video_comment_delete':
                $this->videoCommentDelete($json[self::GROUP_ID], $json);
                break;
            case 'wall_post_new':
                $this->wallPostNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'wall_repost':
                $this->wallRepost($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'wall_reply_new':
                $this->wallReplyNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'wall_reply_edit':
                $this->wallReplyEdit($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'wall_reply_restore':
                $this->wallReplyRestore($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'wall_reply_delete':
                $this->wallReplyDelete($json[self::GROUP_ID], $json);
                break;
            case 'board_post_new':
                $this->boardPostNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'board_post_edit':
                $this->boardPostEdit($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'board_post_restore':
                $this->boardPostRestore($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'board_post_delete':
                $this->boardPostDelete($json[self::GROUP_ID], $json);
                break;
            case 'market_comment_new':
                $this->marketCommentNew($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'market_comment_edit':
                $this->marketCommentEdit($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'market_comment_restore':
                $this->marketCommentRestore($json[self::GROUP_ID], $json[self::OBJECT][self::TEXT], $json);
                break;
            case 'market_comment_delete':
                $this->marketCommentDelete($json[self::GROUP_ID], $json);
                break;
            case 'groupLeave':
                $this->groupLeave($json[self::GROUP_ID], $json);
                break;
            case 'group_join':
                $this->groupJoin($json[self::GROUP_ID], $json);
                break;
            case 'user_block':
                $this->userBlock($json[self::GROUP_ID], $json);
                break;
            case 'user_unblock':
                $this->userUnblock($json[self::GROUP_ID], $json);
                break;
            case 'poll_vote_new':
                $this->pollVoteNew($json[self::GROUP_ID], $json);
                break;
            case 'group_officers_edit':
                $this->groupOfficersEdit($json[self::GROUP_ID], $json);
                break;
            case 'group_change_settings':
                $this->groupChangeSettings($json[self::GROUP_ID], $json);
                break;
            case 'group_change_photo':
                $this->groupChangePhoto($json[self::GROUP_ID], $json);
                break;
            case 'vkpay_transaction':
                $this->vkpayTransaction($json[self::GROUP_ID], $json);
                break;
            case 'app_payload':
                $this->appPayload($json[self::GROUP_ID], $json);
                break;
            default:
                VKBot::sayOk();
                break;
        }
    }

}