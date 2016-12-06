<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "policy_procedure_menu".
 *
 * @property string $id
 * @property string $parent
 * @property string $doc_id
 * @property string $url
 * @property string $label
 * @property boolean $flag
 * @property integer $sort
 *
 * @property PolicyProcedureServices $doc
 */
class PolicyProcedureMenu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'policy_procedure_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id', 'doc_id', 'url', 'label'], 'required'],
            [['id', 'parent', 'sort'], 'integer'],
            [['flag'], 'boolean'],
            [['doc_id'], 'string', 'max' => 11],
            [['url', 'label'], 'string', 'max' => 128],
            [['doc_id'], 'exist', 'skipOnError' => true, 'targetClass' => PolicyProcedureServices::className(), 'targetAttribute' => ['doc_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'doc_id' => Yii::t('app', 'Doc ID'),
            'url' => Yii::t('app', 'Url'),
            'label' => Yii::t('app', 'Label'),
            'flag' => Yii::t('app', 'Flag'),
            'sort' => Yii::t('app', 'Sort'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(PolicyProcedureServices::className(), ['id' => 'doc_id']);
    }
}
