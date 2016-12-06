<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\SluggableBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\BlameableBehavior; // untuk insert created_by dan updated_by ...
use yii\db\BaseActiveRecord;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\validators\FileValidator;
use yii\base\Model;

/**
 * This is the model class for table "policy_procedure_services".
 *
 * @property string $id
 * @property string $title
 * @property string $description
 * @property boolean $is_pdf
 * @property boolean $flag
 * @property boolean $is_active
 * @property string $menu_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PolicyProcedureMenu[] $policyProcedureMenus
 */
class PolicyProcedureServicesUpload extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $filename;

    public static function tableName() {
        return 'policy_procedure_services';
    }

    public function behaviors() {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_by', 'updated_by'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updated_by'
                ],
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    BaseActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    BaseActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['title', 'flag'], 'required'],
                [['description'], 'string'],
                [['is_pdf', 'flag', 'is_active'], 'boolean'],
                [['menu_id', 'created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
                [['filename'], 'file', 'extensions' => 'doc, docx, pdf', 'skipOnEmpty' => false, 'on' => 'insert'],
                ['filename', 'required', 'on' => 'insert'],
                [['id'], 'string', 'max' => 11],
                [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'is_pdf' => Yii::t('app', 'Is Pdf'),
            'flag' => Yii::t('app', 'Flag'),
            'is_active' => Yii::t('app', 'Is Active'),
            'menu_id' => Yii::t('app', 'Menu ID'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPolicyProcedureMenus() {
        return $this->hasMany(PolicyProcedureMenu::className(), ['doc_id' => 'id']);
    }

    public function getUser() {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
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
      public function beforeSave($insert) {

        if ($this->isNewRecord) {
            $this->id = $this->generateKode_Urut(); // set password value
            parent::beforeSave($insert);
        }
        return true;
    }


}
