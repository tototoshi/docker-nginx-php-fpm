<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB\ConnectionFactory;
use App\Form\LoginForm;
use InvalidArgumentException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\SyntaxError;
use Twig\Error\RuntimeError;

class LoginPostController
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
        $form = new LoginForm();
        $form->bindRequest($request)->validate();

        if ($form->hasError()) {
            return $this->twig->render($response, 'login.twig', ['form' => $form]);
        }

        if ($form->getUserId() !== 'admin' || $form->getPassword() !== 'password') {
            $form->getErrors()->set('unauthorized', 'Invalid user ID or password.');
            return $this->twig->render($response, 'login.twig', ['form' => $form]);
        }

        $_SESSION['user_id'] = $form->getUserId();

        return $response->withHeader('Location', '/')->withStatus(302);
    }

}
