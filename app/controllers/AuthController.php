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
                'id'=> $checkauth->user_id,
                'username'=> $checkauth->user_name
                
            ]);

            $user = $this->session->get('user');
            if ($user) {
                $username = $user['username'];
                $this ->view->setVar("username", $username);


            return  $this->response->setJsonContent([
                'success' => true,
                'message' => 'Добро пожаловать,' . $username]);

            }
                
        }
        else{
            $this ->view->setVar("username", "Гость");
            return $this->response->setJsonContent([
                'success' => false,
                'message' => 'Неправильно, попробуй еще раз']);
              
        }
        
    }
    
    $this ->view->setVar("username", "путник");

        $user_id = 2 ;
        $users = Users::findfirst($user_id);
        
        $this->view->pick("balcon/auth");
        $this->view->setTemplateAfter('main');

   
    }
}
