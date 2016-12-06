<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\SluggableBehavior; // untuk timestamp created_at dan updated_at ...
use yii\behaviors\BlameableBehavior; // untuk insert created_by dan updated_by ...
use yii\db\BaseActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "plant".
 *
 * @property string $plant_id
 * @property string $plant_name
 * @property string $flag
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Plant extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'plant';
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
                [['plant_id', 'plant_name'], 'required'],
                ['plant_id', 'unique', 'message' => 'this id available..'],
                [['plant_id', 'plant_name', 'flag'], 'string'],
                [['created_by', 'updated_by'], 'integer'],
                [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'plant_id' => Yii::t('app', 'Plant ID'),
            'plant_name' => Yii::t('app', 'Plant Name'),
            'flag' => Yii::t('app', 'Flag'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}
