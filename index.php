<?php 
use Phalcon\Mvc\Application;
use Phalcon\Autoload\Loader;
use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Mysql;
use Phalcon\Mvc\View;
use Phalcon\Config\Config;
use Phalcon\Mvc\Router;




$loader = new Loader();

$loader->setNamespaces([
    'App\Controllers' => 'C:/xampp/htdocs/balcon/app/controllers/',
    'App\Models'      => 'C:/xampp/htdocs/balcon/app/models/',
]);

$loader->register();
$loader->isRegistered();


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
        'balcon/',[
        'controller' => 'index',
        'action'=> 'index'
        ]
        );
        return $router;
});

 $config = init ($configFilePath);


    

    $di->setShared('db', function () use ($config) {
        return new Mysql(
            [
                'host'     => $config->database->host,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname'   => $config->database->dbname,
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
        echo $response;

    
    }
    
    catch (\Exception $e) {
       echo 'Exception:', $e ->getMessage();
    }

   
