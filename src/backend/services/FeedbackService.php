<?php

namespace bulldozer\feedback\backend\services;

use bulldozer\App;
use bulldozer\feedback\backend\forms\FeedbackForm;
use bulldozer\feedback\common\ar\Feedback;
use yii\base\Exception;

/**
 * Class FeedbackService
 * @package bulldozer\feedback\backend\services
 */
class FeedbackService
{
    /**
     * @param Feedback $feedback
     * @return FeedbackForm
     * @throws \yii\base\InvalidConfigException
     */
    public function getForm(Feedback $feedback): FeedbackForm
    {
        /** @var FeedbackForm $form */
        $form = App::createObject([
            'class' => FeedbackForm::class,
        ]);

        $form->setAttributes($feedback->getAttributes($form->getSavedAttributes()));

        return $form;
    }

    /**
     * @param FeedbackForm $form
     * @param Feedback $feedback
     * @throws Exception
     */
    public function save(FeedbackForm $form, Feedback $feedback): void
    {
        $feedback->setAttributes($form->getAttributes($form->getSavedAttributes()));

        if (!$feedback->save()) {
            throw new Exception('Cant save feedback. Erros: ' . json_encode($feedback->getErrors()));
        }
    }
}