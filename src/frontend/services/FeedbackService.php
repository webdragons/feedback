<?php

namespace bulldozer\feedback\frontend\services;

use bulldozer\App;
use bulldozer\feedback\common\ar\Feedback;
use bulldozer\feedback\common\enums\FeedbackStatusEnum;
use bulldozer\feedback\frontend\forms\FeedbackForm;
use yii\base\Exception;

/**
 * Class FeedbackService
 * @package bulldozer\feedback\frontend\services
 */
class FeedbackService
{
    /**
     * @param FeedbackForm $form
     * @return Feedback
     * @throws \yii\base\InvalidConfigException
     * @throws Exception
     */
    public function save(FeedbackForm $form): Feedback
    {
        /** @var Feedback $feedback */
        $feedback = App::createObject([
            'class' => Feedback::class,
            'name' => $form->name,
            'phone' => preg_replace('~[^0-9]+~','', $form->phone),
            'email' => $form->email,
            'comment' => $form->comment,
            'status' => FeedbackStatusEnum::STATUS_NEW,
        ]);

        if ($feedback->save()) {
            return $feedback;
        }

        throw new Exception('Cant save feedback. Errors: ' . json_encode($feedback->getErrors()));
    }
}