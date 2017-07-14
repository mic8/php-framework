<?php

namespace Kernel;

use Kernel\Router;

class App
{
    private $router;

    public function init()
    {
        session_start();

        $router = include('app/routes.php');
        $this->router = $router;
        $this->router->init();
    }
}