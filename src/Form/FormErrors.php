<?php

declare(strict_types=1);

namespace App\Form;

class FormErrors
{
    /**
     * @param array<string, string> $errors
     */
    public function __construct(private array $errors)
    {
    }

    public static function empty(): FormErrors
    {
        return new FormErrors([]);
    }

    public function isNotEmpty(): bool
    {
        return count($this->errors) > 0;
    }

    public function get(string $key): ?string
    {
        return isset($this->errors[$key]) ? $this->errors[$key] : null;
    }

    /**
     * @return array<string, string>
     */
    public function getAll(): array
    {
        return $this->errors;
    }

    public function set(string $key, string $message): ?string
    {
        return $this->errors[$key] = $message;
    }
}
