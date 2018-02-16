<?php

namespace bulldozer\feedback\backend\controllers;

use bulldozer\App;
use bulldozer\feedback\backend\services\FeedbackService;
use bulldozer\feedback\common\ar\Feedback;
use bulldozer\web\Controller;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

/**
 * Class FeedbackController
 * @package bulldozer\feedback\backend\controllers
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
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex()
    {
        $dataProvider = App::createObject([
            'class' => ActiveDataProvider::class,
            'query' => Feedback::find()->orderBy(['created_at' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function actionUpdate(int $id)
    {
        $feedback = Feedback::findOne($id);

        if ($feedback === null) {
            throw new NotFoundHttpException();
        }

        $model = $this->feedbackService->getForm($feedback);

        if ($model->load(App::$app->request->post()) && $model->validate()) {
            $this->feedbackService->save($model, $feedback);

            App::$app->session->setFlash('success', Yii::t('feedback', 'Feedback successful updated'));

            if (!App::$app->request->post('here-btn')) {
                return $this->redirect(['index']);
            } else {
                return $this->redirect(['update', 'id' => $feedback->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'feedback' => $feedback,
        ]);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete(int $id)
    {
        $feedback = Feedback::findOne($id);

        if ($feedback === null) {
            throw new NotFoundHttpException();
        }

        $feedback->delete();

        App::$app->session->setFlash('success', Yii::t('feedback', 'Feedback successful deleted'));

        return $this->redirect(['index']);
    }
}