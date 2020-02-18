<?php

use Illuminate\Database\Capsule\Manager as Capsule;

return function ($connection) {
    $capsule = new Capsule;

    // Configure connection string
    $capsule->addConnection($connection);

    // Set as Global
    $capsule->setAsGlobal();

    // Initialize
    $capsule->bootEloquent();
};
