<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PolicyProcedureServices */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
            'modelClass' => 'Policy Procedure',
        ]) . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy Procedure'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="policy-procedure-services-update">

    <?=
    $this->render('_form', [
        'model' => $model,
        'model2' => $model2,
    ])
    ?>

</div>
