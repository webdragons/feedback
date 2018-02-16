<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = Yii::t('feedback', 'Feedback');
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
                <div class="table-responsive">
                    <?php Pjax::begin(); ?>
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => [
                            [
                                'label' => Yii::t('feedback', 'ID'),
                                'attribute' => 'id',
                            ],
                            [
                                'label' => Yii::t('feedback', 'Name'),
                                'attribute' => 'name',
                            ],
                            [
                                'label' => Yii::t('feedback', 'E-mail'),
                                'attribute' => 'email',
                            ],
                            [
                                'label' => Yii::t('feedback', 'Phone'),
                                'attribute' => 'phone',
                            ],
                            [
                                'label' => Yii::t('feedback', 'Comment'),
                                'attribute' => 'comment',
                            ],
                            [
                                'label' => Yii::t('feedback', 'Status'),
                                'attribute' => 'statusName',
                            ],
                            [
                                'label' => Yii::t('app', 'Created at'),
                                'attribute' => 'created_at',
                                'format' => 'datetime',
                            ],
                            [
                                'label' => Yii::t('app', 'Updated at'),
                                'attribute' => 'updated_at',
                                'format' => 'datetime',
                            ],
                            [
                                'label' => Yii::t('app', 'Updater'),
                                'attribute' => 'updater.email'
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update} {delete}',
                            ],
                        ],
                    ]); ?>
                    <?php Pjax::end(); ?>
                </div>
            </div>
        </section>
    </div>
</div>

