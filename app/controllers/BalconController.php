<?php
namespace App\Controllers;
use Phalcon\Mvc\Controller;
use App\Models\Users;

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
        echo "sosal2 ";
        $id = 2 ;
        $user = Users::findFirst($id);
        
        $userarr = $user->toArray();
        print_r($userarr['user_name']); 

    }
}

