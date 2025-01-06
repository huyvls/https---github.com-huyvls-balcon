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
        //$this->view ->setVar("need", 0);
        if ($this->request->isPost()) {
        $data = $this->request->getJsonRawBody();
        $username = $data->username ?? null;
        $password = $data->password ?? null;

        $checkauth = Users::findFirst([
            'conditions' => 'user_name = :username: AND password = :password:',
            'bind'       => [
                'username' => $username,
                'password' => $password,
            ]
        ]);

        if ($checkauth) {
            $this->session->set ('user', [
                'id'=> $checkauth->id,
                'username'=> $checkauth->username
            ]);
            return  $this->response->setJsonContent([
                'success' => true,
                'message' => 'Добро пожаловать,' . $username]);

                
        }
        else{
            return $this->response->setJsonContent([
                'success' => false,
                'message' => 'Неправильно, ... волки']);
        }
        
        // if (empty($username) || empty($password)) {
        //     $this->flash->error("Логин и пароль обязательно");
        //     return $this->response->redirect("/");
        //     $need = 1;
        //     $this->view ->setVar("need", $need);
        // }
        
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
