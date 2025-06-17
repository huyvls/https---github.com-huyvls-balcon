<?php 
namespace App\Repositories;

use App\Models\Chat_connections;


class Chat_valueRepository{
    public function getMessages(int $chat_id, int $page = 1): ?\Phalcon\Mvc\Model\ResultsetInterface
    {
        return Chat_connections::find([
            'conditions' => 'chat_id = :chat_id:',
            'bind' => ['chat_id' => $chat_id],
            'order' => 'set_at DESC',
            'limit' => [30 , ($page - 1) * 30 ]
        ]);
    }
}