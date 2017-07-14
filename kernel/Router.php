<?php

namespace Kernel;

class Router
{
    private $routes = [];

    private function mapPrefix($prefix, $type)
    {
        if ($prefix[0] != '/') {
            $prefix = '/' . $prefix;
        }

        return $prefix . '@' . $type;
    }

    private function add($prefix, $target, $type)
    {
        $target = explode('@', $target);

        if (count($target) != 2) throw new \Exception('Error target controller formatting');

        $controller = $target[0];
        $method = $target[1];

        $prefix = $this->mapPrefix($prefix, $type);

        $this->routes[$prefix] = [
            'controller' => $controller,
            'method' => $method,
            'type' => $type
        ];
    }

    public function get($path, $target)
    {
        $this->add($path, $target, 'GET');
    }

    public function post($path, $target)
    {
        $this->add($path, $target, 'POST');
    }

    public function put($path, $target)
    {
        $this->add($path, $target, 'PUT');
    }

    public function patch($path, $target)
    {
        $this->add($path, $target, 'PATCH');
    }

    public function delete($path, $target)
    {
        $this->add($path, $target, 'DELETE');
    }

    private function has($prefix)
    {
        if (isset($this->routes[$prefix])) {
            return true;
        }

        return false;
    }

    public function init()
    {
        $prefix = ACTIVE_ROUTE;
        $type = REQUEST_METHOD;

        $prefix = $prefix . '@' . $type;

        if ($this->has($prefix)) {
            $data = $this->routes[$prefix];
            $controllerName = $data['controller'];
            $className = '\App\\Controllers\\' . $controllerName;
            if (class_exists($className)) {
                $controller = new $className();
                $method = $data['method'];
                if (method_exists($controller, $method)) {
                    $controller->$method();
                } else {
                    throw new \Exception('Method ' . $method . ' not exists in class ' . $controllerName);
                }
            } else {
                throw new \Exception('Controller ' . $controllerName . ' not exists');
            }
        } else {
            throw new \Exception('Route ' . str_replace('@' . $type, null, $prefix) . ' not found');
        }
    }
}