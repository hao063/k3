<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class CommentValidator extends LaravelValidator
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
                'content' => 'required',
            ]
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'content' => 'Nội dung ',
        ];

        /*
         *
         * Validator messages
         *
         */
        $this->messages = [
            'required' => ':attribute' . __(' không được để trống'),
        ];
    }
}
