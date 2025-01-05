<?php
use Phalcon\Mvc\Router;

return function (){
    $router = new Router();

    //Главнгая стр
    $router-> add(
        '/',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Auth',
        'action'=> 'index'
        ]
        );

        return $router;
};