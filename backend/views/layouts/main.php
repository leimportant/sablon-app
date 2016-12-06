<?php
/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AdminLteAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use kartik\sidenav\SideNav;
use yii\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\helpers\Url;

AdminLteAsset::register($this);
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= $this->title ?></title>
        <?php $this->head() ?>
    </head>
    <style type="text/css">
        .pad {
            color: #f6f6f6;
            padding-top: 7px;
            padding-bottom: 5px; 
        }
        .content-header {
            position: relative;
            padding: 50px 15px 0px 10px;
        }
        body {
            font-family: Trebuchet MS;
            font-size: 15px;
            font-style: normal;
            font-variant: normal;
            font-weight: 400;
            line-height: 17.6px;
        }
        .nav-stacked  .nav-pills > li > a {
            border : none;
        }
        .navbar-default .btn-link {
            color: #FFF;
        }
        .breadcrumb > .active {
            color: #fff;
        }
        .breadcrumb {
            padding: 5px 5px;
            margin-bottom: 1px;
            list-style: underline;
            background-color: #454444;
            border-radius: 0px;
            font-size: 15px;
        }
        .content {
            min-height: 700px;
        }
        .nav .nav-pills .nav-stacked .treeview-menu {
            background-color: #1e282c;
            border-radius: 0px;
            color: #1e282c;
        }
        .nav-stacked > li.active > a, .nav-stacked > li.active > a:hover {
            background: #1e282c;
        }
        .nav-stacked > li.active > a, .nav-stacked > li.active > a:hover {
            background-color: #1e282c;
            color: #fff;
            border-top: 0;
            border-left-color: #3c8dbc;
        }
        .nav-stacked > li + li {
            background-color: #1e282c;
            color: #fff;
            margin-top: 0px;
        }
        .nav-stacked > li {
            background-color: #1e282c;
            color: #fff;
            margin-top: 0px;
        }
        .nav {
            padding-left: 0;
            margin-bottom: 0;
            list-style: none;
            border: 0px solid 1e282c;
        }
        .nav > li > a:hover, .nav > li > a:active, .nav > li > a:focus {
            color: #fff;
            background: #1e282c;
            text-decoration: none;
        }
        a {
            outline: none;
        }
        .kv-sidenav li a {
            border-radius: 0;
            border: none;
        }
        .treeview {
            border: none;
        }
        table {
            border-spacing: 0;
            border-collapse: collapse;
            border: 1px solid greenyellow;
        }
        .table-bordered {
            border: 0px solid #ddd;
        }
         container {
            width: 1270px;
        }
      
    </style>
    <body class="skin-blue fixed">
        <div class="wrapper">

            <?php $this->beginBody() ?>
            <header class="main-header">
                <!-- Logo -->
                <?php
                $img = Html::img('@web/images/Logo-Stanli.jpg', ['width' => '50px', 'height' => '50px', 'class' => 'logo']);
                echo Html::a($img, ['/site/index']);
                ?>
                <section class="sidebar">


                    <?php
                    NavBar::begin([
                        'brandLabel' => '',
                        'brandUrl' => Yii::$app->homeUrl,
                        'options' => [
                            'class' => '',
                        ],
                    ]);
                    $menuItems = [
                            ['label' => 'Home', 'url' => ['/site/index']],
                    ];
                    if (Yii::$app->user->isGuest) {
                        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
                    } else {
                        $menuItems[] = '<li class="pad user user-menu ">'
                                . Html::beginForm(['/site/logout'], 'post')
                                . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')', ['class' => 'pad btn btn-link logout']
                                )
                                . Html::endForm()
                                . '</li>';
                    }
                    echo Nav::widget([
                        'options' => ['class' => 'navbar-nav navbar-right'],
                        'items' => $menuItems,
                    ]);
                    NavBar::end();
                    ?>

                </section>
            </header>
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <?php
                            $img = Html::img('@web/images/avatar/avatar.png', ['width' => '50px', 'height' => '50px']);
                            echo Html::a($img, ['/site/index']);
                            ?>
                        </div>
                        <div class="pull-left info">
                            <p><?= Yii::$app->user->identity->username; ?></p>
                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <form action="#" method="get" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" name="q" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                    <ul class="sidebar-menu">
                        <li class="header">MAIN NAVIGATION</li>
                        <li>
                            <?= Html::a('<i class="fa fa-th"></i> <span>Administrator Panel</span> <small class="label pull-right bg-green">new</small>', ['/site',], ['class' => 'profile-link']) ?>
                        </li>

                        <?=
                        SideNav::widget([
                            'type' => SideNav::TYPE_PRIMARY,
                            'options' => ['style' => 'border-color: none'],
                            'headingOptions' => ['class' => 'treeview-menu'],
                            'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id), // di mengambil data dari extension yii2-admin
                            'submenuTemplate' => "\n<ul class='treeview-menu'>\n{items}\n</ul>\n",
                            'encodeLabels' => false
                        ]);
                        ?> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>


            <div class="content-wrapper">
                <!-- Main content -->
                <section class="content">
                    <div class="breadcrumb">

                        <?=
                        Breadcrumbs::widget([
                            'id' => 'breadcrumb',
                            'options' => ['class' => 'breadcrumb'],
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ])
                        ?>   
                    </div>
                    <!-- Default box -->
                    <div class="panel panel-default">

                        <section class="user-panel">
                            <?php Alert::widget() ?>

                            <?= $content ?>
                        </section>

                    </div>
                </section><!-- /.content -->
            </div><!-- /.content-wrapper -->


            <footer class="footer">
                <div class="container">
                    <p class="pull-left">&copy; PT. Stanli Trijaya Mandiri <?= date('Y') ?></p>
                    <!--<p class="pull-right"><?  Yii::powered() ?></p>-->
                </div>
            </footer>

            <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
