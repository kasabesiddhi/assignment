<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property integer $c_id
 * @property integer $c_name
 * @property integer $c_email
 * @property integer $c_address
 * @property integer $c_zip
 * @property integer $c_telephone
 * @property integer $c_dob
 */
class Customer extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'customer';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['c_name', 'c_email', 'c_address', 'c_zip', 'c_telephone', 'c_dob'], 'required'],
            [['c_name', 'c_address'], 'string'],
            ['c_email', 'email'],
            [['c_name',], 'match',
                'pattern' => '/^[a-zA-Z\s]+$/', 'message' => "Please enter valid name"],
            [[ 'c_zip', 'c_telephone'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'c_id' => 'ID',
            'c_name' => 'Name',
            'c_email' => 'Email',
            'c_address' => 'Address',
            'c_zip' => 'Zip',
            'c_telephone' => 'Telephone',
            'c_dob' => 'Dob',
        ];
    }

}
