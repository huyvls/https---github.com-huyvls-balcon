<?php
use Phalcon\Mvc\Router;

return function (){
    $router = new Router();

    //Главнгая стр(авторизации)
    $router-> add(
        '/',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Auth',
        'action'=> 'index'
        ]
        
        );
    //Стр регистрации
    $router-> add(
        '/register',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Register',
        'action'=> 'index'
        ]
        
        );
    //Стр профиля
    $router-> add(
        '/profile',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'index'
        ]
        
        );
            

        return $router;
};