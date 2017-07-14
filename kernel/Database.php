<?php

namespace Kernel;

class Database extends \MySQLi
{
    private $configs = [];

    protected $db;

    public function __construct()
    {
        $this->configs = include('config/database.php');

        parent::__construct($this->configs['host'], $this->configs['username'], $this->configs['password'], $this->configs['database']);
    }
}