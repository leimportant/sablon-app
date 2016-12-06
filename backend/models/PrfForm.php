<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prf_form".
 *
 * @property string $id
 * @property string $payment_to
 * @property string $dept_id
 * @property integer $sub_dept_id
 * @property string $no_prf
 * @property integer $plant_id
 * @property string $duedate_payment
 * @property string $duedate_settlement
 * @property string $claim
 * @property string $total_amount
 * @property string $payment_via
 * @property string $payment_method
 * @property integer $bank_id
 * @property string $bank_office
 * @property string $rekening_no
 * @property string $rekening_name
 * @property string $is_processed
 * @property integer $currency_id
 * @property string $remark
 * @property string $flag
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $approved_by
 * @property string $created_at
 * @property string $updated_at
 * @property string $approved_at
 *
 * @property Bank $bank
 * @property Currency $currency
 * @property PrfFormDetails[] $prfFormDetails
 */
class PrfForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'prf_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'payment_to', 'dept_id', 'sub_dept_id', 'no_prf', 'plant_id', 'duedate_payment', 'claim', 'total_amount', 'payment_via', 'payment_method'], 'required'],
            [['sub_dept_id', 'plant_id', 'bank_id', 'currency_id', 'created_by', 'updated_by', 'approved_by'], 'integer'],
            [['duedate_payment', 'duedate_settlement', 'created_at', 'updated_at', 'approved_at'], 'safe'],
            [['total_amount'], 'number'],
            [['remark'], 'string'],
            [['id', 'no_prf'], 'string', 'max' => 11],
            [['payment_to', 'bank_office', 'rekening_no', 'rekening_name'], 'string', 'max' => 50],
            [['dept_id'], 'string', 'max' => 10],
            [['claim', 'payment_via', 'payment_method', 'is_processed', 'flag'], 'string', 'max' => 1],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'currency_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'payment_to' => Yii::t('app', 'Payment To'),
            'dept_id' => Yii::t('app', 'Dept ID'),
            'sub_dept_id' => Yii::t('app', 'Sub Dept ID'),
            'no_prf' => Yii::t('app', 'No Prf'),
            'plant_id' => Yii::t('app', 'Plant ID'),
            'duedate_payment' => Yii::t('app', 'Duedate Payment'),
            'duedate_settlement' => Yii::t('app', 'Duedate Settlement'),
            'claim' => Yii::t('app', 'Claim'),
            'total_amount' => Yii::t('app', 'Total Amount'),
            'payment_via' => Yii::t('app', 'Payment Via'),
            'payment_method' => Yii::t('app', 'Payment Method'),
            'bank_id' => Yii::t('app', 'Bank ID'),
            'bank_office' => Yii::t('app', 'Bank Office'),
            'rekening_no' => Yii::t('app', 'Rekening No'),
            'rekening_name' => Yii::t('app', 'Rekening Name'),
            'is_processed' => Yii::t('app', 'Is Processed'),
            'currency_id' => Yii::t('app', 'Currency ID'),
            'remark' => Yii::t('app', 'Remark'),
            'flag' => Yii::t('app', 'Flag'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'approved_by' => Yii::t('app', 'Approved By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'approved_at' => Yii::t('app', 'Approved At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBank()
    {
        return $this->hasOne(Bank::className(), ['bank_id' => 'bank_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['currency_id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrfFormDetails()
    {
        return $this->hasMany(PrfFormDetails::className(), ['prf_id' => 'id']);
    }
}
