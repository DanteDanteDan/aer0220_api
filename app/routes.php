<?php

use Slim\App;
use App\Controllers\UserController;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\StudentController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(App $app, Array $middlewares){

    //Call container
    $container = $app->getContainer();
    $settings = $container->get('settings');

    //define('__BASE_PATH__', '/aer0220_api/');

    //Default -> App is running ? / http://localhost/aer0220_api/courses
    $app->get($settings['basePath'], function (Request $request, Response $response, $args) {
        $response->getBody()->write("Running ..");
        return $response;
    });

    $app->group($settings['basePath'], function (RouteCollectorProxy $group) use ($middlewares) {
        // Student Controller
        $group->get('gender', StudentController::class.':getGenders');
        $group->get('courses', StudentController::class.':getCourses');
        $group->get('course/{courses_id}', StudentController::class.':getCourse');
        // User Controller
        $group->post('users', UserController::class.':create');
        $group->get('users', UserController::class.':getAll');
        $group->get('users/{user_id}', UserController::class.':getUser');

    })->add($middlewares['authMiddleware']); // Token Validation

    //SignIn
    $app->post($settings['basePath'].'sign-in', UserController::class.':authenticate');

};
