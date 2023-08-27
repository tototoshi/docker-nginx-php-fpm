<?php

declare(strict_types=1);

namespace App\Auth;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class AuthMiddleware
{
    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        session_start();

        if ($request->getUri()->getPath() === '/login') {
            return $handler->handle($request);
        }

        if (!isset($_SESSION['user_id'])) {
            $response = new Response();
            return $response->withHeader('Location', '/login')->withStatus(302);
        }

        $response = $handler->handle($request);

        return $response;
    }
}
