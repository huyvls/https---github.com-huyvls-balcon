<?php

use Phalcon\Session\Manager;
use Phalcon\Session\Adapter\Stream;


if (!is_dir(__DIR__ . '/sessions/')) {
    mkdir(__DIR__ . '/sessions/', 0755, true);
}
$session = new Manager();
$files = new Stream(
    [
        'savePath'=> __DIR__ . '/sessions/'
    ]
    );
    $session->setAdapter($files);
    return $session;