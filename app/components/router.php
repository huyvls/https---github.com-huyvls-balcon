<?php
use Phalcon\Di\FactoryDefault;

$di->setShared('router', function () {
    $router = new Router();
    $router->add(
        '/about',
        [   'namespace' => 'App/Controllers',
            'controller' => 'Balcon',
            'action'     => 'about',
        ]
    );
    return $router;
});