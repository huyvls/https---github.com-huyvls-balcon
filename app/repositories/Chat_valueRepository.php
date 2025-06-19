<?php 
namespace App\Repositories;

use App\Models\Chat_value;


class Chat_valueRepository{
    public function getMessages(int $chat_id, int $page = 1): ?\Phalcon\Mvc\Model\ResultsetInterface
    {
        return Chat_value::find([
            'conditions' => 'chat_id = :chat_id:',
            'bind' => ['chat_id' => $chat_id],
            'order' => 'sent_at DESC',
            'limit' => 30 , 
            'offset' => ($page - 1) * 30
        ]);
    }
}