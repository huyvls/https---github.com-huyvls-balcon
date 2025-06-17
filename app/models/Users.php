<?php 

namespace App\Models;

use Phalcon\Mvc\Model;

class Users extends Model
{
    public int $user_id;

    public  string $user_name;

    public string $email;

    public string $password;

    public string $registration_date;

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