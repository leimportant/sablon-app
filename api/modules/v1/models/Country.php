<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace api\modules\v1\models;

use \yii\db\ActiveRecord;

/**
 * Country Model
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
class Country extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public static function primaryKey() {
        return ['code'];
    }

    /**
     * Define rules for validation
     */
    public function rules() {
        return [
                [['code', 'name', 'population'], 'required']
        ];
    }

}
