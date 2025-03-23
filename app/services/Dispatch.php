<?php
namespace App\Services;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager;


class Dispatch{
    static function init(){
$dispatcher = new Dispatcher();
$dispatcher->setDefaultNamespace('App\Controllers');


$eventsManager = new Manager();


$eventsManager->attach('dispatch:beforeExecuteRoute', function ($event, $dispatcher) {
   
    $di = $dispatcher->getDI();

    
    $session = $di->get('session');
    $user = $session->get('user');

    $controller = $dispatcher->getControllerName();
    $action = $dispatcher->getActionName();

    $publicRoutes = [
        'Register::index',
        'Auth::index'
    ];

    if (!$user && !in_array("$controller::$action", $publicRoutes)) {
        $dispatcher->forward([
            'controller' => 'Auth',
            'action'     => 'index',
        ]);
        return false; 
    }

});


$dispatcher->setEventsManager($eventsManager);

return $dispatcher;
    }
}