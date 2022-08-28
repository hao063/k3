<?php

namespace App\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;

interface BaseValidatorInterface extends ValidatorInterface
{
    const RULE_LOGIN = 'login';
    const RULE_REGISTER = 'register';
    const RULE_FORGET_PASSWORD = 'forgetPassword';
    const RULE_TOKEN = 'token';
    const RULE_PASSWORD = 'password';
}
