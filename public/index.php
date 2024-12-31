<?php 
use Phalcon\Mvc\Application;
use Phalcon\Autoload\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View;
use Phalcon\Config\Config;
use Phalcon\Mvc\Router;


define("BASE_PATH", dirname(__DIR__) );
define("APP_PATH", BASE_PATH );


$loader = new Loader();

$loader->setNamespaces([
    'App\Controllers' =>  APP_PATH .'/app/controllers/',
    'App\Models'      => APP_PATH .'/app/models/'
]);

$loader->register();


if (!class_exists('App\Controllers\BalconController')) {
    die("Класс 'App\Controllers\BalconController' не найден. Проверьте автозагрузку.");
}


   // var_dump($loader);  


    
 static $configFilePath = 'C:/xampp/htdocs/balcon/config/db.php';

  function init($configFilePath){

if (!file_exists($configFilePath)) {
    die("Ошибка: файл конфигурации {$configFilePath} не найден.");
}

    $configArray = include $configFilePath;

    $config = new Config($configArray);

    return $config;
 }
 $di = new FactoryDefault();


 $di -> setShared("router", function(){


    $router= new Router();


    $router-> add(
        '/',[
        'namespace'  => 'App\Controllers',
        'controller' => 'Balcon',
        'action'=> 'index'
        ]
        );
        return $router;
});

 $config = init ($configFilePath);


    

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

    $di->set('view', function () {
        return new View();
        $view->setView('../app/views/');
        return $view;
    });



    $app = new Application($di);

    try {
        $response = $app ->handle ($_SERVER['REQUEST_URI']);
        $response->send();
         $response->getContent();

    
    }
    
    catch (\Exception $e) {
       echo 'Exception:', $e ->getMessage();
    }

   
