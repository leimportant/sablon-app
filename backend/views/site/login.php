<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<body>
    <div id="container">
        <header id="header" class="navbar navbar-static-top">

        </header>

        <div id="content">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">

                    <div class="panel-heading">
                        <h1 class="panel-title"><i class="fa fa-lock"></i><b>Administrator Portal Login.</b></h1>
                    </div>
                    <div class="panel-body">
                        <div class="form-group"> 
                            <?php
                            $this->registerJs(
                                    'myHideEffect', '$(".flash-success").animate({opacity: 1.0}, 30).fadeOut("slow");', View::POS_READY
                            );
                            ?>
                            <?php if (Yii::$app->session->hasFlash('success')): ?>
                                <div class="alert alert-info">
                                    <?= Yii::$app->session->getFlash('success'); ?>

                                </div>
                            <?php endif; ?>
                            <p>Please fill out the following fields to login:</p>

                            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>


                            <?= $form->field($model, 'username', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1']]) ?>

                            <?= $form->field($model, 'password', ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '2']])->passwordInput() ?>

                            <?= $form->field($model, 'rememberMe')->checkbox() ?>

                            <div class="form-group">
                                <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


