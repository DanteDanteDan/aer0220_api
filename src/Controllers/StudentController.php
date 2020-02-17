<?php

namespace App\Controllers;

use PDO;
use PDOException;
use App\Services\StudentService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StudentController
{

    protected $_container;
    private $_studentService;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
        $this->_studentService = new StudentService();
    }

    public function getAll(Request $request, Response $response) // All
    {
        $result = $this->_studentService->getStudents();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getStudent(Request $request, Response $response, $args) // One
    {
        $result = $this->_studentService->getStudent($args['student_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }


}
