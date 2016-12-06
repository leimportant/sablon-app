<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bank".
 *
 * @property integer $bank_id
 * @property string $bank_name
 * @property string $flag
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PrfForm $bank
 */
class Bank extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bank';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bank_name'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['bank_name'], 'string', 'max' => 50],
            [['flag'], 'string', 'max' => 1],
            [['bank_id'], 'exist', 'skipOnError' => true, 'targetClass' => PrfForm::className(), 'targetAttribute' => ['bank_id' => 'bank_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => Yii::t('app', 'Bank ID'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'flag' => Yii::t('app', 'Flag'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(PrfForm::className(), ['bank_id' => 'bank_id']);
    }
}
