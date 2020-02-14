<?php
use Slim\App;
use Firebase\JWT\JWT;
use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

return function (App $app) {
    //Call container
    $container = $app->getContainer();
    $settings = $container->get('settings');

    // Default
    $app->addBodyParsingMiddleware();
    $app->addErrorMiddleware($settings['displayErrors'], false, false);

    // Custom - Validation Token
    $authMiddleware = function (Request $request, RequestHandler $handler) use($container) {

        $secretKey = $container->get('settings')['secretKey'];
        $token = $request->getHeaderLine('Authorization');

        try {
            JWT::decode($token, $secretKey, ['HS256']);
        } catch(\Exception $ex) {
            $response = new Response();
            return $response->withStatus(401);
        }

        return $handler->handle($request);
    };

    return [
        'authMiddleware' => $authMiddleware
    ];

    //$app->add($authMiddleware); //global
};
