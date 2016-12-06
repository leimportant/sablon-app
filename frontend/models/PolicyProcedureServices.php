<?php

namespace app\models;

use Yii;

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
class PolicyProcedureServices extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'policy_procedure_services';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'description'], 'required'],
            [['description'], 'string'],
            [['is_pdf', 'flag', 'is_active'], 'boolean'],
            [['menu_id', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['id'], 'string', 'max' => 11],
            [['title'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
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
    public function getPolicyProcedureMenus()
    {
        return $this->hasMany(PolicyProcedureMenu::className(), ['doc_id' => 'id']);
    }
}
