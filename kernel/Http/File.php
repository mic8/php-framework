<?php

namespace Kernel\Http;

class File
{
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getFileName()
    {
        return str_replace('.' . $this->getFileExtension(), null, $this->file['name']);
    }

    public function getFileExtension()
    {
        $arr = explode('.', $this->file['name']);

        return $arr[count($arr) - 1];
    }

    public function getSize()
    {
        return $this->file['size'];
    }

    public function getErrorCounter()
    {
        return $this->file['error'];
    }

    public function get()
    {
        return file_get_contents($this->file['tmp_name']);
    }
}