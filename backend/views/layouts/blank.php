<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <style>
            body {
                font-family: Lucida Sans Unicode;
                font-size: 16px;
                font-style: normal;
                font-variant: normal;
                font-weight: 400;
                line-height: 17.6px;
            }
        </style>
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
