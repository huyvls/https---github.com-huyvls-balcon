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


    public static function getAllUsers():array{
        $db = $this ->getDI()->get("db");
        $query = "Select * from users";
        $arr_users =  $db -> query();
    }
}