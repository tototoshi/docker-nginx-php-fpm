<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class HomeController
{

    private Twig $twig;

    public function __construct(private ContainerInterface $container)
    {
        $this->twig = $this->container->get(Twig::class);
    }

    public function __invoke(ServerRequestInterface $request,
                             ResponseInterface      $response,
                             array                  $args): ResponseInterface
    {
        $data = ['name' => 'World'];
        return $this->twig->render($response, 'home.twig', $data);
    }

}