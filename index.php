<?php

include('bootstrap/autoload.php');
include('bootstrap/helper.php');
include('bootstrap/app.php');

header('Access-Control-Allow-Origin:*');

$app = new \Kernel\App();
$app->init();