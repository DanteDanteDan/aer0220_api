<?php

use Slim\App;
use Illuminate\Database\Capsule\Manager as Capsule;

return function (App $app) {

    // Call container
    $container = $app->getContainer();
    $settings = $container->get('settings');

    $db = $settings['db'];

    $capsule = new Capsule;

    // Configure connection string
    $capsule->addConnection($db);

    // Set as Global
    $capsule->setAsGlobal();

    // Initialize
    $capsule->bootEloquent();
};
