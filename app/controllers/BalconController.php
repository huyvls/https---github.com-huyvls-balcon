<?php
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;
use Phalcon\Mvc\View;

 class BalconController extends Controller 
{
    public function balconAction()
    {
    echo "sosal1";
    $user = new Users;
    $user ->user_name = "Sosich_test";
    $user -> password = "1234555854";
    if ($user -> save()) {
        echo " + sohranaet ";
    }
}
    public function indexAction(){
        $id = 1 ;
        $user = Users::findFirst($id);
        
        if ($user) {
        $this-> view->username=$user->user_name;
        $username = $user->user_name;

        $this->view->setVar('username', $username); // из документации фалькона

    }
     else {
    $this->view->username = "Гость";
}

$this->view->pick("balcon/index");
}
}