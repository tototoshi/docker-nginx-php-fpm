<?php

declare(strict_types=1);

namespace App\Form;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @template T
 */
interface FormInterface
{
    public function hasError(): bool;

    public function getErrors(): FormErrors;

    /**
     * @return T
     */
    public function bindRequest(ServerRequestInterface $request);

    public function validate(): void;

}
