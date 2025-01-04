<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;

class BalconController extends Controller 
{
    public function indexAction()
    {
        $user_id = 2 ;
        $users = Users::findfirst($user_id);


        if ($users) {
        $username = $users->user_name; 
            $this ->view->setVar("username", $username);
            $this ->view->setVar("title", "Главная");
        } 
        
        else {

        $username = 'Гость';
        $this->view->username = $username;
        
        
        $this->session->set("user", ["name"=> 'traher', 'id'=> '0111']);
        
    }
        
        $this->view->pick("balcon/index");
        $this->view->setTemplateAfter('main');

   
    }
}
