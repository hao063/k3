<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class AuthValidator extends LaravelValidator
{
    
    /**
     * FormValidator constructor.
     */
    public function __construct(Factory $validator)
    {
        parent::__construct($validator);

        /*
         *
         * Validator rules
         *
         */
        $this->rules = [
            BaseValidatorInterface::RULE_LOGIN => [
                'email' => 'required',
                'password' => 'required',
            ],
            BaseValidatorInterface::RULE_REGISTER => [
                'username' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:8',
            ],
            BaseValidatorInterface::RULE_FORGET_PASSWORD => [
                'email' => 'required|email',
            ],
            BaseValidatorInterface::RULE_TOKEN => [
                'token' => 'required',
            ],
            BaseValidatorInterface::RULE_PASSWORD => [
                'password' => 'required',
                're_password' => 'required_with:password|same:password',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'username' => 'Username ',
            'email' => 'Email ',
            'password' => 'Password ',
            'token' => 'Token ',
            're_password' => 'Re-enter password'
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __(' is empty'),
            'email' => ':attribute' . __(' not exists'),
            'min' => ':attribute' . __(' invalid length'),
        ];
    }
}
