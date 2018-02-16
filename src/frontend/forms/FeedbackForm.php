<?php

namespace bulldozer\feedback\frontend\forms;

use bulldozer\base\Form;

/**
 * Class FeedbackForm
 * @package bulldozer\feedback\frontend\forms
 */
class FeedbackForm extends Form
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $comment;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['name', 'string', 'max' => 255],

            ['email', 'required', 'when' => function() {
                return empty($this->phone);
            }],
            ['email', 'email'],

            ['phone', 'required', 'when' => function() {
                return empty($this->email);
            }],
            ['phone', 'string'],

            ['comment', 'string', 'max' => 10000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function formName(): string
    {
        return '';
    }
}