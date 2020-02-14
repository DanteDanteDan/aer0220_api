<?php

namespace App\Controllers;

use App\Services\StudentService;
use PDO;
use PDOException;
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

    public function getGenders(Request $request, Response $response)
    {

        $sql = "SELECT * FROM aer0220_cat_genders";

        try {
            $db = new DataBase();
            $db = $db->conectDB();
            $content = $db->query($sql);

            $result = $content->fetchAll(PDO::FETCH_OBJ);

        } catch (PDOException $e) {
            echo '{"error" : {"text":' . $e->getMessage() . '}';
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json') //metadata information
            ->withStatus(200);
    }

    public function getCourses(Request $request, Response $response) {

        $result = $this->_studentService->getCourses();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json') //metadata information
            ->withStatus(200);
    }

    public function getCourse(Request $request, Response $response, $args) {

        $result = $this->_studentService->getCourse($args['courses_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json') //metadata information
                        ->withStatus(200);

    }

}
