<?php

namespace App\Models;

use Phalcon\Mvc\Model;

class Chat_value extends Model
{
    public ?int $id = null;

    public  int $chat_id;

    public int $sender_user_id;

    public string $message;

    public string $sent_at;

    private function initialize()
    {
        $this->setSource("chat_value");
    }
}
