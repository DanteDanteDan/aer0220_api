<?php
use DI\Container;
use Slim\Factory\AppFactory;

return function () {
    $container = new Container();

    $settings = require 'settings.php';

    $container->set('settings', function () use ($settings) {
        return $settings;
    });

    AppFactory::setContainer($container);
};
