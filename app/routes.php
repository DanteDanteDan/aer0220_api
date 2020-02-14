<?php

use Slim\App;
use App\Controllers\UserController;
use Slim\Routing\RouteCollectorProxy;
use App\Controllers\StudentController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function(App $app, Array $middlewares){

    // Call container
    $container = $app->getContainer();
    $settings = $container->get('settings');

    // define('__BASE_PATH__', '/aer0220_api/');

    // Default -> Check if the app is running -> http://localhost/aer0220_api
    $app->get($settings['basePath'], function (Request $request, Response $response, $args) {
        $response->getBody()->write("Running ..");
        return $response;
    });

    $app->group($settings['basePath'], function (RouteCollectorProxy $group) use ($middlewares) {

        // Student Controller
            // View Catalogues
        $group->get('cat_cities', StudentController::class.':getCities');
        $group->get('cat_courses', StudentController::class.':getCourses');
        $group->get('cat_genders', StudentController::class.':getGenders');
        $group->get('cat_grade', StudentController::class.':getGrade');
        $group->get('cat_meet_us', StudentController::class.':getMeetUs');
        $group->get('cat_payment_status', StudentController::class.':getPaymentStatus');
        $group->get('cat_payment_type', StudentController::class.':getPaymentType');
        $group->get('cat_relationship', StudentController::class.':getRelationship');
        $group->get('cat_user_types', StudentController::class.':getUserTypes');
            // View payments / Students
        $group->get('payments', StudentController::class.':getPayments');
        $group->get('students', StudentController::class.':getStudents');
        $group->get('students/{student_id}', StudentController::class.':getStudent');
            // Insert Students / payments

        // User Controller
            // View Users
        $group->get('users', UserController::class.':getAll');
        $group->get('users/{user_id}', UserController::class.':getUser');
            // Insert Users
        $group->post('users', UserController::class.':create');

    })->add($middlewares['authMiddleware']); // Token Validation to the group

    // User Controller
        // SignIn
    $app->post($settings['basePath'].'sign-in', UserController::class.':authenticate');

};
