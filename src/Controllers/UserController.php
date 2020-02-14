<?php

namespace App\Controllers;

use App\Services\UserService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{

    protected $_container;
    private $_userService;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
        $this->_userService = new UserService($container);
    }

    public function getAll(Request $request, Response $response) // View All Users
    {

        $result = $this->_userService->getAll();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getUser(Request $request, Response $response, $args) //View One User
    {

        $result = $this->_userService->getUser($args['user_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function create(Request $request, Response $response) // Create User
    {
        $entry = $this->_userService->create(
            (object) $request->getParsedBody()
        );

        $response->getBody()->write($entry->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }


    public function authenticate(Request $request, Response $response) // SignIn and return token
    {

        $body = $request->getParsedBody();
        $result = $this->_userService->authenticate($body['email'], $body['password']);

        if ($result) {
            $response->getBody()->write(json_encode($result));

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(200);
        }

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(401);
    }
}
