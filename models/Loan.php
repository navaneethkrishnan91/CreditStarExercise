<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Loan extends \yii\db\ActiveRecord
{

    public function rules()
    {
        return [
            [['user_id', 'amount', 'interest', 'duration', 'start_date', 'end_date', 'campaign'], 'required'],
        ];
    }

    public static function tableName()
    {
        return 'loan';
    }
}