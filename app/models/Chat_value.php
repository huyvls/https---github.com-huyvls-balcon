<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class Chat_value extends Model
{
    public int $id;

    public  int $chat_id;

    public int $user_id;

    public string $message;

    public string $sent_at;

    private function initialize()
    {
        $this->setSource("chat_value");
    }



    
}