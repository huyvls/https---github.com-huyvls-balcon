<?php

use Phalcon\Mvc\Application,
    Phalcon\Autoload\Loader;
use App\Components\DiContainer;



define("APP_PATH", dirname(__DIR__));


ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = new Loader();

$loader->setNamespaces([
    'App\Controllers' =>  APP_PATH . '/app/controllers/',
    'App\Models'      => APP_PATH . '/app/models/',
    'App\Components'  => APP_PATH . '/app/components/',
    'App\Services'    => APP_PATH . '/app/services/',
    'App\Repositories' => APP_PATH . '/app/repositories/'
]);

$loader->register();


static $configFilePath = APP_PATH . '/config/db.php';

$di = DiContainer::createDI($configFilePath);


$app = new Application($di);

try {
    $response = $app->handle($_SERVER['REQUEST_URI']);
    $response->send();
    $response->getContent();
} catch (\Exception $e) {
    echo 'Exception:', $e->getMessage();
}
