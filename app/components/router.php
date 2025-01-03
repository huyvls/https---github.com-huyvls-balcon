<?php
use Phalcon\Mvc\Router;

return function (){
    $router = new Router();

    //Первая стр
    $router-> add(
        '/',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Balcon',
        'action'=> 'index'
        ]
        );

        return $router;
};