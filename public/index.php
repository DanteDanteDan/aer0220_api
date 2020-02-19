<?php

use Slim\Factory\AppFactory;

error_reporting(E_ALL);
set_error_handler(function ($severidad, $mensaje, $fichero, $línea) {
    if (!(error_reporting() & $severidad)) {
        return;
    }
    throw new \ErrorException($mensaje, 0, $severidad, $fichero, $línea);
});

require __DIR__ . '/../vendor/autoload.php'; //Slim

// Config dependencies
$dependenciesConfig = require __DIR__ . '/../app/dependencies.php';
$dependenciesConfig();

// Create slim instance
$app = AppFactory::create();

// Config middlewares
$middlewaresConfig = require __DIR__ . '/../app/middlewares.php';
$middlewares = $middlewaresConfig($app);

// Config Database - Eloquent
$dbConfig = require __DIR__ . '/../app/db.php';
$dbConfig($app);

// Config routes
$routesConfig = require __DIR__ . '/../app/routes.php';
$routesConfig($app, $middlewares);

$app->run();
