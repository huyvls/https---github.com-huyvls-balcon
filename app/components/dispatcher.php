<?php

use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager;

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
        'register::index',
        'eshkere::index',
        'auth::index'
    ];

    
    if (!$user && !in_array("$controller::$action", $publicRoutes)) {
        $dispatcher->forward([
            'controller' => 'auth',
            'action'     => 'index',
        ]);
        return false; 
    }
});


$dispatcher->setEventsManager($eventsManager);

return $dispatcher;
