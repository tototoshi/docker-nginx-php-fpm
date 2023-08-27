<?php
declare(strict_types=1);

namespace App\Form;

use PHPUnit\Framework\TestCase;

class LoginFormTest extends TestCase
{

    /** @test */
    public function errorWhenUserIdIsEmpty()
    {
        $form = new LoginForm(user_id: '', password: 'password');
        $form->validate();
        $this->assertTrue($form->hasError());
        $this->assertSame($form->getErrors()->get('user_id'), 'Please enter your user ID.');
    }

    /** @test */
    public function errorWhenPasswordIsEmpty()
    {
        $form = new LoginForm(user_id: 'user_id', password: '');
        $form->validate();
        $this->assertTrue($form->hasError());
        $this->assertSame($form->getErrors()->get('password'), 'Please enter your password.');
    }

    /** @test */
    public function okWhenUserIdAndPasswordIsSet()
    {
        $form = new LoginForm(user_id: 'user_id', password: 'password');
        $form->validate();
        $this->assertFalse($form->hasError());
    }

}
