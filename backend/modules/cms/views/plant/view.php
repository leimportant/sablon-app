<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Plant */

$this->title = $model->plant_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-view">

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->plant_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->plant_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'plant_id',
            'plant_name',
            'flag',
        ],
    ]) ?>

</div>
