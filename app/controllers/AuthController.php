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


            $user = $this->session->get('user');
            if ($user) {
                $username = $user['username'];
                $this ->view->setVar("username", $username);
            }
                
        }
        else{
            return $this->response->setJsonContent([
                'success' => false,
                'message' => 'Неправильно, попробуй еще раз']);
                $this ->view->setVar("username", "Гость");
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
        
        $this->view->pick("balcon/index");
        $this->view->setTemplateAfter('main');

   
    }
}
