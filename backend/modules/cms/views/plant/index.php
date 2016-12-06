<?php

use yii\helpers\Html;
#use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use kartik\editable\Editable;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Plants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Plant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php Pjax::begin(); ?>   
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => ['class' => 'table table-bordered table-condensed'],
        'columns' => [
                ['class' => 'kartik\grid\SerialColumn'],
                [
                'class' => '\kartik\grid\CheckboxColumn'
            ],
            'plant_id',
                [
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'plant_name',
                'vAlign' => 'middle',
                'headerOptions' => ['class' => 'kv-sticky-column'],
                'contentOptions' => ['class' => 'kv-sticky-column'],
                'editableOptions' => [
                    'header' => 'Name',
//                    'format' => Editable::FORMAT_BUTTON,
//                    'inputType' => Editable::INPUT_WIDGET,
//                    'data' => $StatusList,
                ]
            ],
//                [
//                'class' => 'kartik\grid\BooleanColumn',
//                'attribute' => 'flag',
//                'vAlign' => 'middle',
//            ],
            [
                'attribute' => 'flag',
                'headerOptions' => ['width' => '80'],
                'filter' => array("1" => "Yes", "0" => "No"),
                'value' => function ($data) {
                    return (($data->flag) == 1) ? "yes" : "No";
                },
            ],
                ['class' => 'kartik\grid\ActionColumn'],
        ],
        'containerOptions' => ['style' => 'overflow: auto'], // only set when $responsive = false
        'beforeHeader' => [
                [
                'columns' => [
                        ['content' => '<h4>Data Plant</h4>', 'options' => ['colspan' => 6, 'class' => 'text-left info']],
//                        ['content' => 'Header Before 2', 'options' => ['colspan' => 2, 'class' => 'text-center warning']],
                ],
                'options' => ['class' => 'skip-export'] // remove this row from export
            ]
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}'
        ],
        'pjax' => true,
        'bordered' => true,
        'striped' => true,
        'condensed' => false,
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
