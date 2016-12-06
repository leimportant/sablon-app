<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\LoginForm;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
//    public $enableCsrfValidation = false;
    public function encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'muni';
        $secret_iv = 'muni123';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            //decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                        [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                        [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
//        return $this->render('index');
        if (!Yii::$app->user->isGuest) {
            return $this->render('index');
        } else
            return $this->goHome();
    }

    public function actionClear() {
        Yii::$app->cache->flush();
    }

    public function actionDelete() {
        $cache = $_GET['c'];
        Yii::$app->cache->delete($cache);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        $this->layout = 'blank.php';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

//    public function beforeAction($action) {
//        if (parent::beforeAction($action)) {
//            // If you want to change it only in one or few actions, add additional check
//            Yii::$app->user->loginUrl = ['site/login'];
//
//            return true;
//        } else {
//            return false;
//        }
//    }

    public function beforeAction($action) {

        if (!parent::beforeAction($action)) {
            return false;
        }
        // Check only when the user is logged in
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->session['userSessionTimeout'] < time()) {
                Yii::$app->user->logout();
            } else {
                Yii::$app->session->set('userSessionTimeout', time() + Yii::$app->params['sessionTimeoutSeconds']);

                return true;
            }
        } else {
            #     Yii::$app->user->loginUrl = ['site/login'];
            return true;
        }
    }

}
