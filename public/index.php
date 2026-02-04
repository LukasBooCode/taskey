<?php

// Autoload dependencies and classes
require __DIR__ . '/../vendor/autoload.php';

use Framework\Request;
use Framework\Kernel;

// Initialize the kernel
$kernel = new Kernel();

// Extract the path from the URL
$urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if (!is_string($urlPath)) {
    $urlPath = '/';
}

// Create the Request object
$request = new Request($_SERVER['REQUEST_METHOD'], $urlPath, $_GET, $_POST);

// Handle the request and get the response
$response = $kernel->handle($request);

// Send the response to the client
$response->echo();
