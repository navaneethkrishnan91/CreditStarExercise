<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Users extends \yii\db\ActiveRecord
{
    public $age; 

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'email', 'personal_code', 'phone'], 'required'],
            ['email', 'email'],
            [['active', 'dead', 'lang', 'age'], 'safe']
        ];
    }

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lang' => 'Language'
        ];
    }
}