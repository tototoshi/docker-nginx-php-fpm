<?php

declare(strict_types=1);

namespace App\Form;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @extends AbstractForm<LoginForm>
 */
class LoginForm extends AbstractForm
{
    public function __construct(
        public string $user_id = '',
        public string $password = '',
    ) {
        parent::__construct();
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function validate(): void
    {
        if ($this->user_id === '') {
            $this->errors->set('user_id', 'Please enter your user ID.');
        }
        if ($this->password === '') {
            $this->errors->set('password', 'Please enter your password.');
        }
    }

    public function bindRequest(ServerRequestInterface $request): LoginForm
    {
        $body = $request->getParsedBody();
        $this->user_id = $body['user_id'] ?? '';
        $this->password = $body['password'] ?? '';
        return $this;
    }

}
