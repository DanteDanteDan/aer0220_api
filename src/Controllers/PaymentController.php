<?php

namespace App\Controllers;

use App\Services\PaymentService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PaymentController
{
    private $_paymentService;

    public function __construct()
    {
        $this->_paymentService = new PaymentService();
    }

    public function getAll(Request $request, Response $response) // All
    {
        $result = $this->_paymentService->getPayments();
        $response->getBody()->write($result->toJson());

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getPayment(Request $request, Response $response, $args) // One
    {
        $result = $this->_paymentService->getPayment($args['payment_id']);

        if ($result === null) {
            return $response->withStatus(404);
        }

        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function getTotalAmount(Request $request, Response $response) // Total Amount
    {
        $result = $this->_paymentService->getTotalAmount();
        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    public function updatePayment(Request $request, Response $response, $args) // Update
    {
        $this->_paymentService->updatePayment(
            $args['payment_id'],
            (object) $request->getParsedBody()
        );

        return $response->withStatus(204);
    }
}
