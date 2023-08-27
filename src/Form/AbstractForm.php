<?php

declare(strict_types=1);

namespace App\Form;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @template T
 * @implements FormInterface<T>
 */
abstract class AbstractForm implements FormInterface
{
    protected FormErrors $errors;

    public function __construct()
    {
        $this->errors = FormErrors::empty();
    }

    public function hasError(): bool
    {
        return $this->getErrors()->isNotEmpty();
    }

    public function getErrors(): FormErrors
    {
        return $this->errors;
    }

    abstract public function bindRequest(ServerRequestInterface $request);

    abstract public function validate(): void;

}
