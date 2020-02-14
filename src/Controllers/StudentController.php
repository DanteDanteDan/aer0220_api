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

    // Catalogue
    public function getCities(Request $request, Response $response) //
    {
        $result = $this->_studentService->getCities();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getCourses(Request $request, Response $response) //
    {
        $result = $this->_studentService->getCourses();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getGenders(Request $request, Response $response) {

        $result = $this->_studentService->getGenders();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getGrade(Request $request, Response $response) //
    {
        $result = $this->_studentService->getGrade();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getMeetUs(Request $request, Response $response) //
    {
        $result = $this->_studentService->getMeetUs();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getPaymentStatus(Request $request, Response $response) //
    {
        $result = $this->_studentService->getPaymentStatus();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getPaymentType(Request $request, Response $response) //
    {
        $result = $this->_studentService->getPaymentType();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getRelationship(Request $request, Response $response) //
    {
        $result = $this->_studentService->getRelationship();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getUserTypes(Request $request, Response $response) //
    {
        $result = $this->_studentService->getUserTypes();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    //
    public function getPayments(Request $request, Response $response) //
    {
        $result = $this->_studentService->getPayments();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getStudents(Request $request, Response $response) // All
    {
        $result = $this->_studentService->getStudents();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getStudent(Request $request, Response $response, $args) // One
    {
        $result = $this->_userService->getStudent($args['student_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }


}
