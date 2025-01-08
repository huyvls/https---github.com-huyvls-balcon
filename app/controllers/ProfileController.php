<?php      
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;

class ProfileController extends Controller{
    public function indexAction(){
    $user = $this->session->get ("user");
    $login = $user['username'];
    $email = $user['email'];

    if ($this->request->isPost()) {
        $email = $this->request->getPost('email', 'string');
        $password = $this->request->getPost('password', 'string');
        $login = $this->request->getPost('username', 'string');
        $agree = $this->request->getPost('agree', 'bool');

        if (!$agree) {
            $this->flashSession->error('проверь еще разок');
        
        }

    }



    $this-> view->setVar ("email", $email);
    $this-> view->setVar ("login", $login);
    $this->view->pick("balcon/profile");
    $this-> view->setVar("title","Настройки");
    $this->view->setTemplateAfter('main');
}
}