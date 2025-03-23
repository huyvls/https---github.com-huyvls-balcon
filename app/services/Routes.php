<?php
namespace App\Services;
use Phalcon\Mvc\Router;

class Routes{
    static function init(): Router    {
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
        '/profiledit',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'index'
        ]
        
        );
    //Ajax изменение темы
    $router-> add(
        '/profile/swapThemeRequest',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'swapThemeRequest'
        ]
            
        )->via(['GET', 'POST']);
            

        return $router;
}
}