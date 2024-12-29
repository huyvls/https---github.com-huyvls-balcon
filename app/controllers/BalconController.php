<?php
namespace Balcon\Controllers;
use Phalcon\Mvc\Controller;
 class BalconController extends Controller 
{
    public function indexAction()
    {
        // Вывод данных для проверки
        echo "Welcome to BalconController!";
    }

}

class indexController extends Controller
{
    public function indexAction(){
        echo "sosal";
    }
}