<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class UserValidator extends LaravelValidator
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
            BaseValidatorInterface::RULE_CREATE => [
                'name' => 'required',
                'email' => 'required|unique:users,email|email',
                'password' => 'required',
                'role_ids' => 'required',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'name' => 'required',
                'role_ids' => 'required',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'name' => 'Name ',
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __(' is empty'),
            'unique' => ':attribute' . __(' already exist'),
        ];
    }
}
