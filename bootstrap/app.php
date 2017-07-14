<?php

$server = $_SERVER;
$requestScheme = $server['REQUEST_SCHEME'];
$requestMethod = strtoupper(trim($server['REQUEST_METHOD']));
$scriptName = $server['SCRIPT_NAME'];
$scriptName = str_replace('/index.php', null, $scriptName);
$scriptName = trim($scriptName);
$httpHost = trim($server['HTTP_HOST']);

$baseUrl = $requestScheme . '://' . $httpHost . $scriptName;

$pathInfo = !isset($server['PATH_INFO']) ? '/' : $server['PATH_INFO'];
$pathInfo = trim($pathInfo);

define('BASE_URL', $baseUrl);
define('ACTIVE_ROUTE', $pathInfo);
define('REQUEST_METHOD', $requestMethod);