<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\helpers\Url;
//use app\models\Menu;
use common\widgets\Menu;
use mdm\admin\components\MenuHelper;
use kartik\sidenav\SideNav;
use yii\jui\Accordion; // untuk accordion
use yii\bootstrap\Dropdown;

//AppAsset::register($this);


$asset = AppAsset::register($this);
$baseUrl = $asset->baseUrl;
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <style type = "text/css" >

            header {
                min-height: 0px;
                background: #002F65 none repeat scroll 0% 0%;
                border-bottom: 1px solid #EDEDED;
                margin: 0px;
                padding: 0px;
            }

            header h1 {
                float: left;
                padding-left: 0px;
                color: #FFF;
                background: #002F65 none repeat scroll 0% 0%;
            }
            h2, .h2 {
                font-size: 22px;
            }
            header hgroup h2 {
                font-size: 22px;
                text-transform: uppercase;
                margin: 0px;
                line-height: 75px;
                color: #FFF;
            }
            nav.navbar {
                margin-top: 2em;
            }
            .navbar-inverse {
                background:  #002F65 none repeat scroll 0% 0%;
                color: #FFF;
            }
            header form {
                float: right !important;
                padding-top: 20px;
            }
            #nav li.over a {

                color: #DDD;
            }
            .navbar-nav > li > a {
                color: #FFF;
            }
            .navbar-inverse .navbar-nav > li > a {
                color: #DEDEDE;
            }
            .container {
                width: 1250px;
            }
            .caret {
                display: inline-block;
                width: 0px;
                height: 0px;
                margin-left: 1px;
                vertical-align: middle;
                border-top: 3px dashed;
                border-right: 3px solid transparent;
                border-left: 3px solid transparent;
            }
            header h1 img {
                padding-right: 0em;
                border-right: 0px solid #002F65;
                display: inline !important;

            }
            footer#foot {
                background: #333 none repeat scroll 0% 0%;
                color: #DDD;
                padding: 1em 0px;
            }
            .col-md-7 {
                width: 68.3333%;
            }
            .ui-menu { width: 272px; border:0px;}
            .ui-widget {
                font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
                font-size: 14px;
            }
            .simple-section-nav-2 li a {
                padding: 5px;
                display: block;
            }
            .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
                color: #23527C;
                background-color: #fff;
            }
            .navbar {
                border-radius: 0px;
            }
            .col-md-12 {
                position: relative;
                min-height: 100%;
                padding-right: 15px;
                padding-left: 15px;
            }
            .panel {
                margin-bottom: 20px;
                background-color: #FFF;
                border: 0px solid transparent;
                border-radius: 4px;
                box-shadow: 0px 1px 1px rgba(0, 0, 0, 0.05);
            }
        </style>

    </head>
    <script>
        $(function () {
            $("#menu").menu({
                position: {my: "left bottom", at: "left+10 bottom+30 top+20"}
            });
        });
    </script>
    <header class="dark-bg">
        <nav class="container">
            <hgroup class="row">
                <h1>
                    <?php
                    $img = Html::img('@web/images/logo.png', ['width' => '70px', 'height' => '50px']);
                    echo Html::a($img, ['/site/index']);
                    ?>
                </h1>
                <nav class="col-md-7 col-xs-12 form-inline left">
                    <h2>  <?php echo isset($this->pageTitle) ? $this->pageTitle : Yii::$app->name; ?></h2>
                </nav>
                <nav class="col-md-3 col-xs-12 form-inline right">
                    <fieldset class="form-group">
                        <form method="get" action="<?php echo Url::to(''); ?>                                                                                   ?>">
                            <input type="search" class="form-control" placeholder="search" name="q" value="<?= isset($_GET['q']) ? Html::encode($_GET['q']) : ''; ?>" />
                            <input class="btn btn-primary" value="Search" type="submit">
                        </form>
                    </fieldset>
                </nav>

            </hgroup>

        </nav>
    </header>
    <body>
        <?php $this->beginBody() ?>
        <section id="content_area" class="container">
            <article class="col-md-12" id="content">
                <?= $content ?>
            </article>
        </section>



        <?php
//                    SideNav::widget([
//                        'type' => SideNav::TYPE_DEFAULT,
//                        'heading' => isset($this->pageTitle) ? $this->pageTitle : Yii::$app->name,
//                        'options' => ['class' => 'sidebar-menu sidebar main-sidebar'],
//                        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id), // di mengambil data dari extension yii2-admin
//                        'encodeLabels' => false
//                    ]);
        ?>

        <?php
//                    echo yii\jui\Menu::widget([
//                        'id' => 'menu',
//                        'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id),
//                    ]);
        ?>
        <!--                </div>
                    </aside>
                    <article class="col-md-12" id="content">
        <?php /*
          Breadcrumbs::widget([
          'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ])
          ?>
          <?= Alert::widget() */ ?>
                      
                    </article>
                </section>-->
        <footer id="foot">
            <section class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="col-lg-10">
                            <div class="footer-widget">
                                <div class="textwidget"><h5 class="quick-links-heading">Office :</h5>
                                    <p>
                                        Kawasan Industri Trikencana Kav. 59-60<br>
                                        Jl. Terusan Kopo Km. 11,5<br>
                                        Bandung 40971 Indonesia<br>
                                        Phone: +62-22-5891070<br>
                                        Fax: +62-22-5891225 <br>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <div class="quick-links-container">
                            <div class="footer-widget">
                                <h5 class="quick-links-heading">Quick Links</h5>



                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3">
                        <div class="quick-links-container">
                            <div class="footer-widget">
                                <h5 class="quick-links-heading">Help</h5>

                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-10">
                        <p class="copyright">Copyright © 2015 <a href="http://www.stanli.co.id/">PT. Stanli Trijaya Mandiri</a>, All rights reserved.</p>
                    </div>

                </div>
            </section>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
