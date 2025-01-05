<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;
use Phalcon\Http\Request;
use Phalcon\Http\Response;

class AuthController extends Controller 
{
    public function indexAction()
    {
        $this->view ->setVar("need", 0);
        if ($this->request->isPost()) {
        $username = trim($this->request->getPost("username", "string"));
        $password = trim($this->request->getPost("password","string"));

        if (empty($username) || empty($password)) {
            $this->flash->error("Логин и пароль обязательно");
            return $this->response->redirect("/");
            $need = 1;
            $this->view ->setVar("need", $need);
        }
        
    }

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

        $this ->view->setVar('auth', '0');
        
    }
        
        $this->view->pick("balcon/index");
        $this->view->setTemplateAfter('main');

   
    }
}
