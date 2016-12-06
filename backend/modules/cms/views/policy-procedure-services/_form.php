<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use app\models\PolicyProcedureMenu;
use kartik\select2\Select2;
use yii\bootstrap\ActiveField;

/* @var $this yii\web\View */
/* @var $model app\models\PolicyProcedureServices */
/* @var $form yii\widgets\ActiveForm */
?>


<style>
    .form-container form input, .form-container form textarea {
        padding: 10px;
        height: 50px;
        font-size: 20px;
        border: 1px solid #AEAEAE;
    }
    label[for="policyprocedureservices-description"] { display: none !important; }
    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-top: 4px;
    }
    .form-container form label span {
        color: #4D4747;
    }

</style>

<div class="policy-procedure-services-form">
    <div class="form-container-3">
        <?php
        $form = ActiveForm::begin([
                    'id' => 'policy-procedure-services-form',
//                    'placeholdersFromLabels' => true,
        ]);
        ?>
        <p><strong>Parent </strong></p>
        <?php
        $menuList = PolicyProcedureMenu::find()->where(['flag' => 1])->all();
        $listData = ArrayHelper::map($menuList, 'id', 'label');
        echo $form->field($model, 'parent')->widget(Select2::classname(), [
            'data' => $listData,
            'options' => ['placeholder' => '-- Top Menu --'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
        ?>
        <?= $form->field($model2, 'label')->textInput(['maxlength' => true]); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Title : Use title as menu'])->label(false); ?>
        <p><strong>Descriptions </strong></p>  
        <?=
        $form->field($model, 'description')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'auto',
                'inline' => false,
                'placeholder' => 'Desss',
            ],
        ]);
        ?>

        <?= $form->field($model2, 'sort')->textInput(['placeholder' => 'Sorting Number'])->label(false); ?>

        <?=
        $form->field($model, 'flag')->widget(Select2::classname(), [
            'data' => ['0' => 'Draft', '1' => 'Publish'],
            'options' => ['placeholder' => '--Select Flag--'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label(false);
        ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
