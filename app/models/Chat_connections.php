<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class Chat_connections extends Model
{
    public  ?int $chat_id = null;

    public int $user1_id;

    public int $user2_id;


    private function initialize()
    {
        $this->setSource("chat_connections");
    }



    
}