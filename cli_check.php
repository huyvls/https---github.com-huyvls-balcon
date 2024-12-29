<?php

use Phalcon\Loader;
if (extension_loaded('phalcon')) {
    echo "Phalcon загружен.\n";

    if (class_exists('Phalcon\Autoload\Loader;')) {
        echo "Phalcon\Loader; доступен.\n";
    } else {
        echo "Phalcon\Loader; недоступен.\n";
    }
} else {
    echo "Phalcon не загружен.\n";
}
