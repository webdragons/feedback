<?php

namespace bulldozer\feedback\backend\forms;

use bulldozer\base\Form;
use bulldozer\feedback\common\enums\FeedbackStatusEnum;
use Yii;

/**
 * Class FeedbackForm
 * @package bulldozer\feedback\backend\forms
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
     * @var int
     */
    public $status;

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['name', 'string', 'max' => 255],

            ['email', 'email'],

            ['phone', 'string'],

            ['comment', 'string', 'max' => 10000],

            ['status', 'required'],
            ['status', 'in', 'range' => array_keys(FeedbackStatusEnum::$list)],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return [
            'name' => Yii::t('feedback', 'Name'),
            'email' => Yii::t('feedback', 'E-mail'),
            'phone' => Yii::t('feedback', 'Phone'),
            'comment' => Yii::t('feedback', 'Comment'),
            'status' => Yii::t('feedback', 'Status'),
        ];
    }

    /**
     * @return array
     */
    public function getSavedAttributes(): array
    {
        return [
            'name',
            'email',
            'phone',
            'comment',
            'status',
        ];
    }
}