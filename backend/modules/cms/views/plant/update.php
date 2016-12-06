<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Plant */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Plant',
]) . $model->plant_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->plant_id, 'url' => ['view', 'id' => $model->plant_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="plant-update">

  
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
