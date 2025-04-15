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
    //Изменение темы
    $router-> add(
        '/profile/swapThemeRequest',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'swapThemeRequest'
        ]  
        )->via(['GET', 'POST']);
    //Получение темы
    $router-> add(
        '/profile/getThemeRequest',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'getThemeRequest'
        ]  
        )->via(['GET', 'POST']);
    //Изменение данных профиля
    $router-> add(
        '/editRequest',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Profile',
        'action'=> 'editRequest'
        ]  
        )->via(['GET', 'POST']);
            

        return $router;
}
}