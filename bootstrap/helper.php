<?php

function dd($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';
}

function url($path)
{
    if ($path[0] === '/') return BASE_URL . $path;

    return BASE_URL . '/' . $path;
}

function asset($path)
{
    if ($path[0] === '/') return BASE_URL . '/resources' . $path;

    return BASE_URL . '/resources/' . $path;
}

function view($path, $params)
{
    $view = new \Kernel\View();
    $view->render($path, $params);
}

function redirect($path)
{
    header('Location: ' . BASE_URL . $path);
}