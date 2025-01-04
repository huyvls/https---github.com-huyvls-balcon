<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;

class BalconController extends Controller 
{
    public function indexAction()
    {
        $user_id = 1 ;
        $users = Users::findfirst($user_id);
        $username = $users->user_name; 
        if ($username) {
            $this ->view->setVar("username", $username);
        } else {
        $this->view->username = "Гость";

        
        
    }
        
        $this->view->pick("balcon/index");

   
    }
}
