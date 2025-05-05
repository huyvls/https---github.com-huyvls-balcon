<?php

namespace App\Components;

use Phalcon\Di\FactoryDefault;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\View;
use Phalcon\Config\Config;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Flash\Direct;
use Phalcon\Html\Escaper;
use Phalcon\Di\DiInterface;
use App\Services\Session;
use App\Services\Routes;
use App\Services\Dispatch;
use App\Services\UserSettingsService;
use App\Components\Profile\ProfileEditor;
use App\Components\Profile\ProfileValidator;

class DiContainer
{
    public static function createDI(string $configFilePath): DiInterface
    {
        $configArray = include $configFilePath;
        $config = new Config($configArray);

        $di = new FactoryDefault();

        $di->setShared('config', $config);

        $di->setShared('router', fn() => Routes::init());
        $di->setShared('session', function () {
            $session = Session::init();
            $session->start();
            return $session;
        });

        $di->setShared('dispatcher', fn() => Dispatch::init());
        $di->setShared('UserSettingsService', fn() => UserSettingsService::init());

        $di->setShared('db', fn() => new Mysql([
            'host'     => $config->host,
            'username' => $config->username,
            'password' => $config->password,
            'dbname'   => $config->dbname,
        ]));

        $di->setShared('voltService', function ($view): Volt {
            $volt = new Volt($view);
            $volt->setOptions([
                'always'        => true,
                'compileAlways' => true,
                'extension'     => '.volt',
                'separator'     => '_',
                'stat'          => false,
                'path'          => APP_PATH . '/cache/volt/',
                'prefix'        => 'blin_blinskiy',
            ]);
            return $volt;
        });

        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(APP_PATH . '/app/views/');
            $view->registerEngines([
                '.volt' => 'voltService',
            ]);
            return $view;
        });

        $di->set('flash', function () use ($di): Direct {
            $escaper = new Escaper();
            $session = $di->getShared('session');
            $flash = new Direct($escaper, $session);
            $flash->setCssClasses([
                'error'   => 'alert alert-danger',
                'success' => 'alert alert-success',
                'notice'  => 'alert alert-info',
                'warning' => 'alert alert-warning'
            ]);
            return $flash;
        });

        $di->setShared(
            'ProfileEditor',
            function () {
                $validator = new ProfileValidator;
                return new ProfileEditor($validator);
            }
        );

        return $di;
    }
}
