<?php

namespace Kernel;

class View
{
    private $configs = [];

    public function __construct()
    {
        $this->configs = include('config/view.php');
    }

    public function render($path, $params)
    {
        ob_start();
        extract($params);
        include_once($this->configs['base'] . '/header.phtml');
        include($this->configs['base'] . '/' . $path . '.phtml');
        include_once($this->configs['base'] . '/footer.phtml');
    }
}