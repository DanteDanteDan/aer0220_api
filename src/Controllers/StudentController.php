<?php

namespace App\Controllers;

use App\Services\StudentService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class StudentController
{

    private $_studentService;

    public function __construct()
    {
        $this->_studentService = new StudentService();
    }

    // Get ->
    public function getAll(Request $request, Response $response) // All
    {
        $result = $this->_studentService->getStudents();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getCount(Request $request, Response $response) // Count
    {
        $result = $this->_studentService->getCountStudents();
        $response->getBody()->write(json_encode($result));

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

    public function getStudentsCourses(Request $request, Response $response, $args) // Count students in course
    {
        $result = $this->_studentService->getStudentsCourses($args['courses_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getAmountCourses(Request $request, Response $response, $args) // Sum amount per course
    {
        $result = $this->_studentService->getAmountCourses($args['courses_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    // Post ->
    public function create1(Request $request, Response $response, $args) // Create Student
    {
        // check if exists
        $entry = $this->_studentService->getExistStudent((object) $request->getParsedBody());


        if ($entry === null) { //  if does not exist, enroll in course 1
            $courses_id = 1;
            $entry = $this->_studentService->create((object) $request->getParsedBody(), $courses_id);

            $response->getBody()->write($entry->toJson());

            // getAmount
            $amount = $this->_studentService->getAmount((object) $request->getParsedBody(), $courses_id);
            $payment_types_id = $request->getParsedBody()['payment_types_id'];

            if ( $payment_types_id == 1 ) { // monthly

                $percentage = $this->_studentService->getPercentage($entry->city_id);

                $perCent = 100;
                $extraCost = $percentage->percentage;
                $normalAmount = $amount->amount;


                $totalExtraAmount = $normalAmount + (($normalAmount * $extraCost) / $perCent);

            } else {

                $totalExtraAmount = $amount->amount;

            }

            // Create Payment at the same time
                                // _paymentService
            $entryPayment = $this->_studentService->createPayment((object) $request->getParsedBody(), $entry->id, $totalExtraAmount);

            $response->getBody()->write($entryPayment->toJson());

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(201);

        } else {    // if exist, add 1 to the course that belongs

            $courses_id = $entry->courses_id;
            $student_id = $entry->student_id;

            $courses_id = $courses_id + 1;
            $entry = $this->_studentService->renewStudent((object) $request->getParsedBody(), $courses_id);


            // getAmount
            $amount = $this->_studentService->getAmount((object) $request->getParsedBody(), $courses_id);
            // if payment_types == 1
            // Aplicar porcentaje


            // Create Payment
            $entryPayment = $this->_studentService->createPayment((object) $request->getParsedBody(), $student_id, $amount->amount);

            $response->getBody()->write($entryPayment->toJson());

            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(201);

        }
    }

    public function create(Request $request, Response $response, $args) // Create Student
    {
        // check if exists
        $entry = $this->_studentService->getExistStudent((object) $request->getParsedBody());

        if ($entry === null) { //  if does not exist, enroll in course 1

            $courses_id = 1;

            // Create
            $entry = $this->_studentService->create((object) $request->getParsedBody(), $courses_id);

            $student_id = $entry->id; // extract id to make the payment

            $response->getBody()->write($entry->toJson());

        } else { // if exist, add 1 to the course that belongs

            $student_id = $entry->student_id; // extract id only if exist
            $courses_id = $entry->courses_id;

            $courses_id = $courses_id + 1;

            // Update
            $entry = $this->_studentService->renewStudent((object) $request->getParsedBody(), $courses_id);

            $response->getBody()->write($entry->toJson());
        }

        // See amount to pay for the course
        $amount = $this->_studentService->getAmount((object) $request->getParsedBody(), $courses_id);

        // extract payment_type and city
        $payment_types_id = $request->getParsedBody()['payment_types_id'];
        $city_id = $request->getParsedBody()['city_id'];

        if ( $payment_types_id == 1 ) { // monthly payments

            $percentage = $this->_studentService->getPercentage($city_id); // extra amount to pay depending on the city

            $perCent = 100;
            $extraCost = $percentage->percentage;
            $normalAmount = $amount->amount;


            $totalExtraAmount = $normalAmount + (($normalAmount * $extraCost) / $perCent); // Total + extra cost

        } else { // Single payments

            $totalExtraAmount = $amount->amount; // there is no extra cost with single payment

        }

        // Create Payment at the same time
        $entryPayment = $this->_studentService->createPayment((object) $request->getParsedBody(), $student_id, $totalExtraAmount);

        $response->getBody()->write($entryPayment->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(201);

    }


}
