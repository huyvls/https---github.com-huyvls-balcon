<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;
use App\Models\UserSettings;
use App\Controllers\BaseController;


class AuthController extends BaseController 
{
    public function indexAction()
    {

        $this ->view->setVar("reg", false);
        //$this->view ->setVar("need", 0);
        if ($this->request->isPost()) {
        $data = $this->request->getJsonRawBody();
        $login = $data->username ?? null;
        $password = $data->password ?? null;


        $checkauth = Users::findFirst([
            'conditions' => 'user_name = :login: OR email = :login: AND password = :password:',
            'bind' => [
                'login' => $login,
                'password' => $password,
            ]
        ]);

        if ($checkauth) {
            $this->session->set ('user', [
                'id'=> $checkauth->user_id,
                'username'=> $checkauth->user_name, 
                'email'=> $checkauth->email
                
            ]);

            $usetting = UserSettings::findFirst([
                'conditions' => 'user_id = :user_id:',
                'bind'       => [
                    'user_id' => $checkauth->user_id,
                ]
            ]);

            if($usetting){
            $this->session->set ('user_settings', [
                'theme'=> $usetting->theme,
                'text_color'=> $usetting->text_color, 
            ]);
           }

           
            $user = $this->session->get('user');
            if ($user) {
                $username = $user['username'];
                $this ->view->setVar("username", $username);


            return  $this->response->setJsonContent([
                'theme' => $usetting->theme,
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
        
        


    $registered = $this->session->get('reg');
    if ($registered) {
    $check = $registered['Y'];
    $this ->view->setVar("reg", $check);
    }

    $this-> view->setVar("title","Авторизация");
    $this->view->pick("balcon/auth");
    $this->view->setTemplateAfter('main');  
   
    }
}
