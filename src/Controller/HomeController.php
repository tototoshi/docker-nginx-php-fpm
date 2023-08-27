<?php

declare(strict_types=1);

namespace App\Controller;

use App\DB\ConnectionFactory;
use App\DB\MySQLInformationDao;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Views\Twig;

class HomeController
{
    public function __construct(
        private ConnectionFactory $connectionFactory,
        private Twig $twig,
        private MySQLInformationDao $mySQLInformationDao,
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
            'name' => $_SESSION['user_id'],
            'mysql_version' => $this->mySQLInformationDao->getMysqlVersion($this->connectionFactory->getConnection()),
        ];
        return $this->twig->render($response, 'home.twig', $data);
    }

}
