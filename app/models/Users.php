<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public $user_id;

    public $user_name;

    public $email;

    public $password;

    public $registration_date;

    private function initialize()
    {
        $this->setSource("users");
    }



    public static function findByUserId($user_id): ?Users{
        $user = Users::findFirst([
            'conditions' => 'user_id = :user_id:',
            'bind' =>['user_id' => $user_id]
        ]);
        return $user;
    }
}