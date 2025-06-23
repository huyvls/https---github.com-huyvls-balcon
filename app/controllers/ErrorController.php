<?php
namespace App\Controllers;

class ErrorController{
    public function notFoundAction(){
        file_put_contents('C:/zxc/workk.txt', "404 вызван\n", FILE_APPEND);
    }
}