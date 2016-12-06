<?php

namespace app\modules\cms\controllers;

use Yii;
use app\models\PolicyProcedureServices;
use app\models\PolicyProcedureServicesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\filters\AccessRule;
use yii\db\Query;
use yii\web\UploadedFile;
use yii\db\ActiveQuery;
use app\models\PolicyProcedureMenu;
use app\models\PolicyProcedureServicesUpload;

/**
 * PolicyProcedureServicesController implements the CRUD actions for PolicyProcedureServices model.
 */
class PolicyProcedureServicesController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'rules' => [
                        [
                        'actions' => ['create', 'update', 'delete', 'remove', 'upload', 'updatepdf', 'updatepdf'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                        [
                        'actions' => ['view', 'search', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'remove' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all PolicyProcedureServices models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new PolicyProcedureServicesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PolicyProcedureServices model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    public function actionSee($id) {
        if ($model = $this->findModel($id)) {
            
        } return $this->render('vDoc', [
                    'model' => $model,
        ]);
    }

    /**
     * Creates a new PolicyProcedureServices model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new PolicyProcedureServices();
        $model2 = new PolicyProcedureMenu();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {

                $model->is_active = 1;
                $model->is_pdf = 0;
                $model->menu_id = $model2->parent;

                if ($model->save(false)) {

                    $model2->parent = $model2->parent;
                    $model2->doc_id = $model->id;
                    $model2->url = '/policy-procedure-services/view?id=' . $model->id;
                    $model2->label = $model2->label;
                    $model2->sort = $model2->sort;
                    $model2->flag = $model->flag;
                    $model2->save(false);
                    $transaction->commit();

                    Yii::$app->getSession()->setFlash('success', ['type' => 'GROWL']);

                    return $this->redirect(['index']);
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }
        return $this->render('create', ['model' => $model, 'model2' => $model2]);
    }

    /**
     * Updates an existing PolicyProcedureServices model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $model2 = $this->findModel2($id);

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $model->menu_id = $model2->parent;
                if ($model->save(false)) {

                    $model2->parent = $model2->parent;
                    $model2->label = $model2->label;
                    $model2->flag = $model->flag;
                    $model2->parent = $model2->parent;
                    $model2->url = '/policy-procedure-services/view?id=' . $model->id;

                    $model2->save(false);
                    $transaction->commit();
                } else {
                    $transaction->rollback();
                }

                Yii::$app->session->setFlash('success', 'Update data successful!');
                return $this->redirect(['index']);
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        } else {
            return $this->render('update', [
                        'model' => $model,
                        'model2' => $model2,
            ]);
        }
    }

    public function actionUpload() {
        $model = new PolicyProcedureServicesUpload();
        $model2 = new PolicyProcedureMenu();

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {

            $model->filename = UploadedFile::getInstance($model, 'filename');

            $webroot = Yii::getAlias('@webroot');

            $path_info = pathinfo($model->filename);
            $file_extension = $path_info["extension"];

            $transaction = Yii::$app->db->beginTransaction();
            try {

                if ($file_extension !== 'pdf') {
                    $pic = $model->id . '.' . $file_extension;
                    $files = $webroot . '/files/policyandprocedureServices/' . $pic;
                    $model->filename->saveAs($files);

                    $setup = shell_exec('D:\PDFConverter\word2pdf.exe /source ' . $files . ' /target ' . $files . ' ');
                    print $setup;
                    @unlink($files);
                } else if ($file_extension === 'pdf') {
                    $pic = PolicyProcedureServicesUpload::generateKode_Urut() . '.pdf';
                    $files = $webroot . '/files/policyandprocedureServices/' . $pic;
                    $model->filename->saveAs($files);
                }

                $model->description = PolicyProcedureServicesUpload::generateKode_Urut() . '.pdf';
                $model->is_pdf = 1;
                $model->is_active = 1;
                $model->menu_id = $model2->parent;

                if ($model->save(false)) {

                    $model2->parent = $model->parent;
                    $model2->doc_id = $model->id;
                    $model2->url = '/policy-procedure-services/see?id=' . $model->id;
                    $model2->label = $model->label;
                    $model2->sort = $model2->sort;
                    $model2->flag = $model->flag;
                    $model2->save(false);


                    $transaction->commit();
                    Yii::$app->session->setFlash('success', 'Data successful!');
                    return $this->redirect(['index']);
                } else {
                    $transaction->rollback();
                }
            } catch (Exception $e) {
                $transaction->rollback();
                throw $e;
            }
        }
        return $this->render('upload', ['model' => $model, 'model2' => $model2]);
    }

    public function actionUpdatepdf($id) {
        $model = $this->findModelUpload($id);
        $model2 = $this->findModel2($id);

        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {

            $model->filename = UploadedFile::getInstance($model, 'filename');
            $webroot = Yii::getAlias('@webroot');
            $path_info = pathinfo($model->filename);
             $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($model->validate()) {

                        if (!empty($model->filename)) {
                            $file_extension = $path_info["extension"];
                            @unlink($webroot . '/files/policyandprocedureServices/' . $model->id . '.pdf');

                            if ($file_extension !== 'pdf') {
                                $pic = $model->id . '.' . $file_extension;
                                $files = $webroot . '/files/policyandprocedureServices/' . $pic;
                                $model->filename->saveAs($files);

                                $setup = shell_exec('D:\PDFConverter\word2pdf.exe /source ' . $files . ' /target ' . $files . ' ');
                                print $setup;
                                @unlink($files);
                            } else if ($file_extension === 'pdf') {
                                $pic = $model->id . '.pdf';
                                $files = $webroot . '/files/policyandprocedureServices/' . $pic;
                                $model->filename->saveAs($files);
                            }

                            $model->description = $model->id . '.pdf';
                            $model->is_pdf = 1;
                            $model->is_active = 1;
                            $model->menu_id = $model->parent;
                        }
                    }
                    if ($model->save(false)) {
                        $model2->parent = $model2->parent;
                        $model2->doc_id = $model->id;
                        $model2->url = '/policy-procedure-services/see?id=' . $model->id;
                        $model2->label = $model2->label;
                        $model2->sort = $model2->sort;
                        $model2->flag = $model->flag;
                        $model2->save(false);

                        $transaction->commit();
                        Yii::$app->session->setFlash('success', 'Data successful!');
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollback();
                    throw $e;
                }
            }
     
        return $this->render('updatepdf', [
                    'model' => $model,
                    'model2' => $model2,
        ]);
    }

    /**
     * Deletes an existing PolicyProcedureServices model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionRemove($id) {
        $model = $this->findModel($id);
        $model2 = $this->findModel2($id);

        $transaction = Yii::$app->db->beginTransaction();
        $connection = \Yii::$app->db;
        try {
            $connection->createCommand()
                    ->update('policy_procedure_services', ['is_active' => 0], 'id =:id')
                    ->bindParam(':id', $id)
                    ->execute();

            $connection->createCommand()
                    ->update('policy_procedure_menu', ['flag' => 0], 'doc_id =:id')
                    ->bindParam(':id', $id)
                    ->execute();
            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the PolicyProcedureServices model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PolicyProcedureServices the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = PolicyProcedureServices::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModel2($id) {
        if (($model = PolicyProcedureMenu::find()
                ->where(["doc_id" => $id])
                ->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUpload($id) {
        if (($model = PolicyProcedureServicesUpload::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public static function generateKode_Urut() {
        $_d = date("ymd");
        $_left = $_d;
        $_first = "0001";
        $_len = strlen($_left);
        $no = $_left . $_first;

        $last_po = PolicyProcedureServicesUpload::find()
                ->where("left(id, " . $_len . ") = :_left", [":_left" => $_left])
                ->orderBy(["id" => SORT_DESC])
                ->one();

        if ($last_po != null) {
            $_no = substr($last_po->id, $_len);
            $_no++;
            $_no = substr("0000", strlen($_no)) . $_no;
            $no = $_left . $_no;
        }

        return $no;
    }

}
