<?php
declare(strict_types=1);

namespace App\View;

use Slim\Csrf\Guard;
use Slim\Views\Twig;
use Twig\TwigFilter;

class TwigFactory
{

    public function __construct(
        private string $templates_directory,
        private Guard $csrf_guard)
    {
    }

    public function create(): Twig
    {
        $twig = Twig::create($this->templates_directory, ['cache' => false]);
        $twig->getEnvironment()->addFilter(new TwigFilter('L', function ($string) {
            return gettext($string);
        }));

        $key_pair = $this->csrf_guard->generateToken();
        $twig->getEnvironment()->addGlobal('__csrf_token_name_key', $this->csrf_guard->getTokenNameKey());
        $twig->getEnvironment()->addGlobal('__csrf_token_name', $key_pair['csrf_name']);
        $twig->getEnvironment()->addGlobal('__csrf_token_value_key', $this->csrf_guard->getTokenValueKey());
        $twig->getEnvironment()->addGlobal('__csrf_token_value', $key_pair['csrf_value']);

        return $twig;
    }
}