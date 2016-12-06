<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Plant */

$this->title = Yii::t('app', 'Create Plant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Plants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plant-create">

 

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
