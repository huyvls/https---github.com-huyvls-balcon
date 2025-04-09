<?php

use Phalcon\Mvc\Application, 
Phalcon\Autoload\Loader,
Phalcon\Di\FactoryDefault,
Phalcon\Db\Adapter\Pdo\Mysql,
Phalcon\Mvc\View,
Phalcon\Config\Config;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Flash\Direct;
use Phalcon\Html\Escaper;
use App\Services\Session;
use App\Services\Routes;
use App\Services\Dispatch;
use App\Services\UserSettingsService;



define("BASE_PATH", dirname(__DIR__));
define("APP_PATH", BASE_PATH);

ini_set('display_errors', 1);
error_reporting(E_ALL);

$loader = new Loader();

$loader->setNamespaces([
    'App\Controllers' =>  APP_PATH . '/app/controllers/',
    'App\Models'      => APP_PATH . '/app/models/',
    'App\Components'  => APP_PATH . '/app/components/',
    'App\Services'    => APP_PATH . '/app/services/'
]);

$loader->register();


static $configFilePath = APP_PATH . '/config/db.php';

function init($configFilePath)
{

    if (!file_exists($configFilePath)) {
        die("Ошибка: файл конфигурации {$configFilePath} не найден.");
    }

    $configArray = include $configFilePath;

    $config = new Config($configArray);

    return $config;
}
$di = new FactoryDefault();


$di->setShared("router", function () {
    return Routes::init();
});

 $config = init($configFilePath);


$di->setShared('session', function () {
    $componentSession = Session::init();
    $componentSession->start();
    return $componentSession;
});


$di->setShared('dispatcher', function () {
    return  Dispatch::init();
});


$di->setShared('UserSettingsService', function () {
    return  UserSettingsService::init();
});


$di->setShared('db', function () use ($config) {
    return new Mysql(
        [
            'host'     => $config->host,
            'username' => $config->username,
            'password' => $config->password,
            'dbname'   => $config->dbname,
        ]
    );
});

$di->setShared(
    'voltService',
    function ($view) {
        $volt = new Volt($view);
        $volt->setOptions(
            [
                'always'    => true,
                'compileAlways' => true,
                'extension' => '.volt',
                'separator' => '_',
                'stat'      => false,
                'path'      => APP_PATH . '/cache/volt/',
                'prefix'    => 'blin_blinskiy',
            ]
        );

        return $volt;
    }
);



$di->set(
    'view',
    function ()    {
        $view = new View();
        $view->setViewsDir(APP_PATH . '/app/views/');

        $view->registerEngines(
            [
                '.volt' => 'voltService',
            ]
        );

        return $view;
    }
);

$di->set(
    'flash',
    function () use ($di) {

        $escaper = new Escaper();
        $session = $di->getShared('session');
        $flash =  new Direct($escaper, $session);
        $flash->setCssClasses([
            'error'   => 'alert alert-danger',
            'success' => 'alert alert-success',
            'notice'  => 'alert alert-info',
            'warning' => 'alert alert-warning'
        ]);
        return $flash;
    }
);



$app = new Application($di);

try {
    $response = $app->handle($_SERVER['REQUEST_URI']);
    $response->send();
    $response->getContent();
} catch (\Exception $e) {
    echo 'Exception:', $e->getMessage();
}
