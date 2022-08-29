<?php

namespace App\Validators;

use Illuminate\Contracts\Validation\Factory;
use Prettus\Validator\LaravelValidator;

/**
 * Class FormValidator.
 */
class PostValidator extends LaravelValidator
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
                'title' => 'required|unique:posts,title',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'required',
            ],
            BaseValidatorInterface::RULE_UPDATE => [
                'title' => 'required|unique:posts,title,{$id}',
                'img' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'content' => 'required',
            ],
        ];

        /*
         *
         * Validator attributes
         *
         */
        $this->attributes = [
            'title' => 'Title ',
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
