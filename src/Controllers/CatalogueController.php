<?php

namespace App\Controllers;

use App\Services\CatalogueService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CatalogueController
{

    protected $_container;
    private $_catalogueService;

    public function __construct()
    {
        $this->_catalogueService = new CatalogueService();
    }

    public function getCities(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getCities();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getCourses(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getCourses();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getGenders(Request $request, Response $response)
    {

        $result = $this->_catalogueService->getGenders();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getGrades(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getGrades();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getMeetUs(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getMeetUs();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getPaymentsStatus(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getPaymentsStatus();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getPaymentTypes(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getPaymentTypes();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getRelationships(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getRelationships();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getUserTypes(Request $request, Response $response)
    {
        $result = $this->_catalogueService->getUserTypes();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
