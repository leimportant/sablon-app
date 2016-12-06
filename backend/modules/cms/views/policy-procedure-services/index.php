<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PolicyProcedureServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Policy Procedure Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-procedure-services-index">
    <?php foreach (Yii::$app->session->getAllFlashes() as $message):; ?>
        <?php
        echo Growl::widget([
            'type' => Growl::TYPE_GROWL,
            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : 'Confirmation!',
            'icon' => (!empty($message['icon'])) ? $message['icon'] : 'fa fa-warning',
            'body' => (!empty($message['message'])) ? Html::encode($message['message']) : 'Congratulation. Data Succesfull!' . '</br>',
            'showSeparator' => false,
            'progressBarOptions' => ['class' => 'progress-bar-warning'],
            'delay' => 0, //This delay is how long before the message shows
            'pluginOptions' => [
                'delay' => (!empty($message['duration'])) ? $message['duration'] : 1000, //This delay is how long the message shows for
                'placement' => [
                    'from' => (!empty($message['positonY'])) ? $message['positonY'] : 'top',
                    'align' => (!empty($message['positonX'])) ? $message['positonX'] : 'right',
                ],
                'showProgressbar' => false,
            ]
        ]);
        ?>
    <?php endforeach; ?>
    <p>
        <?= Html::a(Yii::t('app', 'Create Data'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Upload File'), ['upload']) ?>
    </p>
    <?php Pjax::begin(); ?>  
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                'attribute' => 'id',
                'headerOptions' => ['width' => '90'],
            ],
            'title',
            [
                'attribute' => 'flag',
                'headerOptions' => ['width' => '100'],
                'filter' => array("1" => "Publish", "0" => "Draft"),
                'value' => function ($data) {
                    return (($data->flag) == 1) ? "Publish" : "Draft";
                },
            ],
//    [
            [
                'class' => 'kartik\grid\ActionColumn',
                'headerOptions' => ['width' => '100'],
                'template' => '{view} {view2} {update} {updatepdf} {remove}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return $model->is_pdf == '0' ? Html::a('<span class="glyphicon glyphicon-list-alt"></span>', $url, [
                                    'title' => Yii::t('app', 'View Data'),
                                ]) : '';
                    },
                    'view2' => function ($url, $model) {
                        return $model->is_pdf == '1' ? Html::a('<span class="glyphicon glyphicon glyphicon-tasks"></span>', $url, [
                                    'title' => Yii::t('app', 'View Document'),
                                ]) : '';
                    },
                    'update' => function ($url, $model) {
                        return $model->is_pdf == '0' ? Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'title' => Yii::t('app', 'Update Data'),
                                ]) : '';
                    },
                    'updatepdf' => function ($url, $model) {
                        return $model->is_pdf == '1' ? Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'title' => Yii::t('app', 'Update pdf'),
                                ]) : '';
                    },
                    'remove' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'title' => Yii::t('app', 'remove'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to remove this item?'),
                                    'data-method' => 'post',
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'title' => Yii::t('app', 'delete'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                        ]);
                    },
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        return Url::to(['view?id=' . $model->id]);
                    }
                    if ($action === 'view2') {
                        return Url::to(['see?id=' . $model->id]);
                    }
                    if ($action === 'update') {
                        return Url::to(['update?id=' . $model->id]);
                    }
                    if ($action === 'updatepdf') {
                        return Url::to(['updatepdf?id=' . $model->id]);
                    }
                    if ($action === 'remove') {
                        return Url::to(['remove?id=' . $model->id]);
                    }
                    if ($action === 'delete') {
                        return Url::to(['delete?id=' . $model->id]);
                    }
                }

            ],
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => true,
        'responsive' => true,
        'hover' => true,
        'floatHeader' => false,
        'showPageSummary' => false,
        'panel' => [
            'type' => GridView::TYPE_PRIMARY
        ],
    ]);
    ?>
    <?php Pjax::end(); ?></div>
