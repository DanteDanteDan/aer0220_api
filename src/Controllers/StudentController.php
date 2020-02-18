<?php

namespace App\Controllers;

use App\Services\StudentService;
use App\Services\PaymentService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StudentController
{

    private $_studentService;
    private $_paymentService;

    public function __construct()
    {
        $this->_studentService = new StudentService();
        $this->_paymentService = new PaymentService();
    }

    // Get ->
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

    // Post ->
    public function create(Request $request, Response $response, $args) // Create Student
    {
        $entry = $this->_studentService->create((object) $request->getParsedBody());

        $response->getBody()->write($entry->toJson());

                            // _paymentService
        $entryPayment = $this->_studentService->createPayment((object) $request->getParsedBody(), $entry->id);

        $response->getBody()->write($entryPayment->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(201);
    }
}
