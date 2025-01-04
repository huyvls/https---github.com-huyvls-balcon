<?php
namespace App\Controllers;

use Phalcon\Mvc\Controller;
use App\Models\Users;

class BalconController extends Controller 
{
    public function indexAction()
    {
        // Установка переменной для представления
        $this->view->username = "Гость";

        // Проверяем, корректно ли настроен viewsDir и существует ли файл
        $viewPath = $this->view->getViewsDir() . 'balcon/index.volt';
        echo "Checking file at path: " . $viewPath . "<br>";
        echo "$viewPath". "<br>";
        if (!file_exists($viewPath)) {
            throw new \Exception("View file not found: " . $viewPath);
        }

        
        $this->view->pick("balcon/index");

    }
}
