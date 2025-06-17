<?php

namespace App\Services;

use Phalcon\Mvc\Router;

class Routes
{

    //TODO убрать все роуты в базу и распаковывать форычем мб 
    static function init(): Router
    {
        $router = new Router();

        //Главнгая стр
        $router->add(
            '/',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Auth',
                'action' => 'index'
            ]
        );
        //Авторищзация
        $router->add(
            '/auth',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Auth',
                'action' => 'auth'
            ]
        )->via(['POST']);;
        //Стр регистрации
        $router->add(
            '/register',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Register',
                'action' => 'index'
            ]
        );
        //Стр профиля
        $router->add(
            '/profiledit',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Profile',
                'action' => 'index'
            ]
        );
        //Изменение темы
        $router->add(
            '/profile/swapThemeRequest',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Profile',
                'action' => 'swapThemeRequest'
            ]
        )->via(['GET', 'POST']);
        //Получение темы
        $router->add(
            '/profile/getThemeRequest',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Profile',
                'action' => 'getThemeRequest'
            ]
        )->via(['GET', 'POST']);
        //Изменение данных профиля
        $router->add(
            '/editRequest',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Profile',
                'action' => 'editRequest'
            ]
        )->via(['GET', 'POST']);
        //Чаты
        $router->add(
            '/chat',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Chat',
                'action' => 'index'
            ]
        )->via(['GET', 'POST']);
        //Проверка существования пользователя
        $router->add(
            '/chatUserExist',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Chat',
                'action' => 'existRequest'
            ]
        )->via(['POST']);
        //Получение чатов
        $router->add(
            '/getChats',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Chat',
                'action' => 'getChatsRequest'
            ]
        )->via(['GET', 'POST']);
        //Создание чата
        $router->add(
            '/createChat',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Chat',
                'action' => 'createRequest'
            ]
        )->via(['POST']);
        //Удаление чата
        $router->add(
            '/deleteChat',
            [
                'namespace'  => 'App\Controllers',
                'controller' => 'Chat',
                'action' => 'deleteRequest'
            ]
        )->via(['POST']);


        return $router;
    }
}
