<?php

namespace App\Repositories;

use App\Models\Chat_value;


class Chat_valueRepository
{
    public function getMessages(int $chat_id, int $page = 1): ?\Phalcon\Mvc\Model\ResultsetInterface
    {
        return Chat_value::find([
            'conditions' => 'chat_id = :chat_id:',
            'bind' => ['chat_id' => $chat_id],
            'order' => 'sent_at ASC',
            'limit' => 30,
            'offset' => ($page - 1) * 30
        ]);
    }

    public function saveMessage(int $chat_id, string $text, int $user_id) {
        $value = new Chat_value;
        $value->assign(
            [
                'chat_id' => $chat_id,
                'sender_user_id' => $user_id,
                'message' => $text,
                'sent_at' => date('Y-m-d H:i:s')
            ]
        );
        if ($value->save()) {
            return;
        } else {
            throw new \Exception('Не удалось сохранить сообщение');
        }
    }
}
