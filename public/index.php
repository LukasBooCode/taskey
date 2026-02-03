<?php

$method = $_SERVER;

require __DIR__ . '/../vendor/autoload.php';

use Framework\Request;
use Framework\Kernel;

// Extract the path from the URL
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

$kernel = new Kernel();

$request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

$response = $kernel->handle($request);

$response->echo();
