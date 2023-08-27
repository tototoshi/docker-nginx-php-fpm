<?php

declare(strict_types=1);

namespace App\I18N;

use Locale;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class I18NMiddleware
{
    public function __construct(private string $locale_dir)
    {
    }

    public function __invoke(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $localeFromHttp = Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']);

        if ($localeFromHttp === 'ja') {
            setlocale(LC_ALL, 'ja_JP.UTF-8');
        }

        bindtextdomain('messages', $this->locale_dir);
        textdomain("messages");

        return $handler->handle($request);
    }

}
