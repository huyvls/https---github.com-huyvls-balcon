<?php      
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;


class RegisterController extends Controller
{
    public function indexAction(){

    


        $this->view->pick("balcon/register");
        $this->view->setTemplateAfter('main');

    }
}


















       // if (empty($username) || empty($password)) {
        //     $this->flash->error("Логин и пароль обязательно");
        //     return $this->response->redirect("/");
        //     $need = 1;
        //     $this->view ->setVar("need", $need);
        // }