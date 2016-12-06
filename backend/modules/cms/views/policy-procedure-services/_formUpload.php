<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use app\models\PolicyProcedureMenu;

/* @var $this yii\web\View */
/* @var $model app\models\PolicyProcedureServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="policy-procedure-services-form">

    <?php
    $form = ActiveForm::begin([
                'id' => 'policy-procedure-services-form',
                'options' => [
                    'enctype' => 'multipart/form-data'
                ],
            ])
    ?>

    <?php
    $menuList = PolicyProcedureMenu::find()->where(['flag' => 1])->all();
    $listData = ArrayHelper::map($menuList, 'id', 'label');
    echo $form->field($model2, 'parent')->dropDownList($listData, ['prompt' => '-- Top Menu --']);
    ?>

    <?= $form->field($model2, 'label')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'filename')->fileInput() ?>

    <?= $form->field($model2, 'sort')->textInput() ?>

    <?= $form->field($model, 'flag')->dropDownList(['0' => 'Draft', '1' => 'Publish']); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
