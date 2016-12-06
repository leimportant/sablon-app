<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PolicyProcedureServices */

$this->title = Yii::t('app', 'Create Policy Procedure');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Policy Procedure'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="policy-procedure-services-edit-upload">


    <?=
    $this->render('_formUpload', [
        'model' => $model, 'model2' => $model2,
    ])
    ?>

</div>
