<?php

namespace bulldozer\feedback\frontend\controllers;

use bulldozer\App;
use bulldozer\feedback\frontend\forms\FeedbackForm;
use bulldozer\feedback\frontend\services\FeedbackService;
use yii\rest\Controller;

/**
 * Class FeedbackController
 * @package bulldozer\feedback\frontend\controllers
 */
class FeedbackController extends Controller
{
    /**
     * @var FeedbackService
     */
    private $feedbackService;

    /**
     * FeedbackController constructor.
     * @param string $id
     * @param $module
     * @param FeedbackService $feedbackService
     * @param array $config
     */
    public function __construct(string $id, $module, FeedbackService $feedbackService, array $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->feedbackService = $feedbackService;
    }

    /**
     * @return array|FeedbackForm
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionCreate()
    {
        /** @var FeedbackForm $form */
        $form = App::createObject([
            'class' => FeedbackForm::class,
        ]);

        if ($form->load(App::$app->request->post()) && $form->validate()) {
            $feedback = $this->feedbackService->save($form);

            return [
                'id' => $feedback->id,
            ];
        }

        return $form;
    }
}