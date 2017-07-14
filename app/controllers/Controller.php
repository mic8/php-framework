<?php

namespace App\Controllers;

use Kernel\View;

class Controller
{
    public function view($path, $params)
    {
        $view = new View();
        $view->render($path, $params);
    }
}