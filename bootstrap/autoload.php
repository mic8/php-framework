<?php

spl_autoload_register(function($className) {
    if (file_exists($className . '.php')) {
        include_once($className . '.php');
    } else {
        throw new \Exception('Class ' . $className . ' not found');
    }
});