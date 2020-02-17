<?php

namespace App\Controllers;

use PDO;
use PDOException;
use App\Services\PaymentService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PaymentController
{

    protected $_container;
    private $_paymentService;

    // constructor receives container instance
    public function __construct(ContainerInterface $container)
    {
        $this->_container = $container;
        $this->_paymentService = new PaymentService();
    }

    //
    public function getPayments(Request $request, Response $response) //
    {
        $result = $this->_paymentService->getPayments();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }




}
