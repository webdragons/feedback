<?php

use bulldozer\feedback\backend\widgets\SaveButtonsWidget;
use bulldozer\feedback\common\enums\FeedbackStatusEnum;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var \bulldozer\feedback\backend\forms\FeedbackForm $model
 * @var \bulldozer\feedback\common\ar\Feedback $feedback
 */

$this->title = Yii::t('feedback', 'Update feedback: {id}', ['id' => $feedback->id]);
$this->params['breadcrumbs'][] = $feedback->id;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="row">
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                </div>

                <h2 class="panel-title"><?= Html::encode($this->title) ?></h2>
            </header>

            <div class="panel-body">
                <?php $form = ActiveForm::begin(); ?>

                <?php if ($model->hasErrors()): ?>
                    <div class="alert alert-danger">
                        <?= $form->errorSummary($model) ?>
                    </div>
                <?php endif ?>

                <?= $form->field($model, 'status')->dropDownList(FeedbackStatusEnum::listData(), [
                    'prompt' => Yii::t('app', 'Not selected'),
                ]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'comment')->textarea() ?>

                <?= SaveButtonsWidget::widget(['isNew' => false]) ?>

                <?php ActiveForm::end(); ?>
            </div>
        </section>
    </div>
</div>
