<?php
use Phalcon\Di\FactoryDefault;

$di->setShared('router', function () {
    $router = new Router();
    $router->add(
        '/about',
        [
            'controller' => 'index',
            'action'     => 'about',
        ]
    );
    return $router;
});