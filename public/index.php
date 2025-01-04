<?php 
use Phalcon\Mvc\Application;
use Phalcon\Autoload\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View;
use Phalcon\Config\Config;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\View\Engine\Volt;


define("BASE_PATH", dirname(__DIR__) );
define("APP_PATH", BASE_PATH );

ini_set('display_errors', 1);
error_reporting(E_ALL);

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


   $componentRouter =  include APP_PATH . '/app/components/router.php';
   return $componentRouter();
});

 $config = init ($configFilePath);


 $di -> setShared('session', function(){
    $componentSession = include APP_PATH .'/app/components/session.php';
    $componentSession->start();
    return $componentSession;
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
                    'extension' => '.volt',
                    'separator' => '_',
                    'stat'      => true,
                    'path'      => APP_PATH . '/cache/volt/',
                    'prefix'    => '-prefix-',
                ]
            );
    
            return $volt;
        }
    );
    
    

    $di->set('view', function () {
        $view = new View();
        $view->setViewsDir( APP_PATH . '/app/views/');
    
        $view->registerEngines(
            [
                '.volt' => 'voltService',
            ]
        );

        return $view;
    }
);
    
    
    

    

    file_put_contents("C:/xampp/htdocs/balcon/puti.txt", APP_PATH, FILE_APPEND);


    $app = new Application($di);

    try {
        $response = $app ->handle ($_SERVER['REQUEST_URI']);
        $response->send();
         $response->getContent();

    
    }
    
    catch (\Exception $e) {
       echo 'Exception:', $e ->getMessage();
    }

   
