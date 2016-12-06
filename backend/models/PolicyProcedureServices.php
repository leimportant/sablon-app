<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\SluggableBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\BlameableBehavior; // untuk insert created_by dan updated_by ...
use yii\db\BaseActiveRecord;
use yii\db\Expression;

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
 * @property PolicyProcedueMenu[] $policyProcedueMenus
 */
class PolicyProcedureServices extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public $parent;
    public $label;
    public $sorting;

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
//                'value' => Yii::$app->formatter->asDatetime(date('Y-m-d h:i:s')), untuk ke database mssql
                'value' => new Expression('NOW()'), // untuk ke database mysql
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['label', 'title', 'description'], 'required'],
                [['description', 'label'], 'string'],
                [['is_pdf', 'flag', 'is_active'], 'boolean'],
                [['menu_id', 'created_by', 'updated_by', 'sorting', 'parent'], 'integer'],
                [['sorting'], 'default', 'value' => 1],
                [['created_at', 'updated_at'], 'safe'],
                [['id'], 'string', 'max' => 11],
                [['title'], 'string', 'max' => 100],
                [['menu_id'], 'exist', 'skipOnError' => true, 'targetClass' => PolicyProcedureMenu::className(), 'targetAttribute' => ['menu_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'label' => Yii::t('app', 'Label'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'is_pdf' => Yii::t('app', 'Is Pdf'),
            'flag' => Yii::t('app', 'Flag'),
            'is_active' => Yii::t('app', 'Is Active'),
            'sorting' => Yii::t('app', 'Sorting Number'),
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
    public function getPolicyProcedueMenus() {
        return $this->hasMany(PolicyProcedueMenu::className(), ['doc_id' => 'id']);
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

        $last_po = PolicyProcedureServices::find()
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
