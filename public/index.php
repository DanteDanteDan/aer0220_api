<?php

use Slim\Factory\AppFactory;

error_reporting(E_ALL);
set_error_handler(function ($severidad, $mensaje, $fichero, $línea) {
    if (!(error_reporting() & $severidad)) {
        return;
    }

    throw new \ErrorException($mensaje, 0, $severidad, $fichero, $línea);
});

require __DIR__ .'/../vendor/autoload.php';       //Slim
require __DIR__ .'/../app/DataBase.php';   //Database conection

// Config dependencies
$dependenciesConfig = require __DIR__ . '/../app/dependencies.php';
$dependenciesConfig();

// Create slim instance
$app = AppFactory::create();

// Config middlewares
$middlewaresConfig = require __DIR__ . '/../app/middlewares.php';
$middlewares = $middlewaresConfig($app);

// Config Database
$dbConfig = require __DIR__ . '/../app/db.php';
$dbConfig($app->getContainer()->get('settings')['db']);

// Config routes
$routesConfig = require __DIR__ . '/../app/routes.php';
$routesConfig($app, $middlewares);

$app->run();

//http://localhost/aer0220_api/gender

//get      select 200
//post     insert 201 //registro creado
//put      update 204 //contenido modificado / no espera respuesta
//delete          204 //contenido modificado / no espera respuesta
