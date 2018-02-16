<?php

namespace bulldozer\feedback\backend;

use bulldozer\App;
use bulldozer\base\BackendModule;
use Yii;
use yii\i18n\PhpMessageSource;

/**
 * Class Module
 * @package bulldozer\catalog\backend
 */
class Module extends BackendModule
{
    public $defaultRoute = 'feedback';

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();

        if (empty(App::$app->i18n->translations['feedback'])) {
            App::$app->i18n->translations['feedback'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/../messages',
            ];
        }
    }

    /**
     * @inheritdoc
     * @throws \yii\base\InvalidConfigException
     */
    public function createController($route)
    {
        $validRoutes = ['feedback'];
        $isValidRoute = false;

        foreach ($validRoutes as $validRoute) {
            if (strpos($route, $validRoute) === 0) {
                $isValidRoute = true;
                break;
            }
        }

        return (empty($route) or $isValidRoute)
            ? parent::createController($route)
            : parent::createController("{$this->defaultRoute}/{$route}");
    }

    /*
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        $action->controller->view->params['breadcrumbs'][] = ['label' => Yii::t('feedback', 'Feedback'), 'url' => ['/feedback']];

        return parent::beforeAction($action);
    }

    /**
     * @return array
     */
    public function getMenuItems(): array
    {
        $moduleId = isset(App::$app->controller->module) ? App::$app->controller->module->id : '';
        $controllerId = isset(App::$app->controller) ? App::$app->controller->id : '';

        return [
            [
                'label' => Yii::t('feedback', 'Feedback'),
                'icon' => 'fa fa-commenting-o',
                'url' => ['/feedback'],
                'rules' => ['feedback'],
                'active' => $moduleId == 'feedback',
            ],
        ];
    }
}