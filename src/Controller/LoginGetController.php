<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\LoginForm;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class LoginGetController
{
    public function __construct(
        private Twig $twig,
    ) {
    }

    /**
     * @param array{} $args
     */
    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface      $response,
        array                  $args
    ): ResponseInterface {
        $data = [
            'form' => new LoginForm(),
        ];
        return $this->twig->render($response, 'login.twig', $data);
    }

}
