<?php

namespace Kernel\Http;

class Request
{
    private $params;
    private $requests;

    public function __construct()
    {
        $this->requests = [
            'GET' => $_GET,
            'POST' => $_POST
        ];

        $this->bind();
    }

    public function bind()
    {
        $this->params = $this->requests[REQUEST_METHOD];

        if (REQUEST_METHOD === 'POST') {
            foreach($_FILES as $key => $file) {
                $this->params[$key] = new File($file);
            }
        }
    }

    public function all()
    {
        return $this->params;
    }

    public function only(array $keys)
    {
        $params = [];

        foreach($keys as $key) {
            if ($this->params[$key]) {
                $params[$key] = $this->params[$key];
            }
        }

        return $params;
    }

    public function has($_key)
    {
        foreach($this->params as $key => $value) {
            if ($key === $_key) {
                return true;
            }
        }

        return false;
    }

    public function input($key)
    {
        if ($this->has($key)) {
            return $this->params[$key];
        }

        return null;
    }
}