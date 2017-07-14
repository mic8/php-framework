<?php

namespace Kernel;

class Storage
{
    private $configs = [];

    public function __construct()
    {
        $this->configs = include('config/storage.php');
    }

    public function put($dest, $source)
    {
        $paths = explode('/', $dest);
        $file = $paths[count($paths) - 1];

        $dirPath = $this->configs['base'] . str_replace($file, null, $dest);
        if (!is_dir($dirPath)) {
            mkdir($dirPath);
        }

        file_put_contents($this->configs['base'] . $dest, $source);
    }

    public function get($path)
    {
        return file_get_contents($this->configs['base'] . $path);
    }
}