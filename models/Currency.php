<?php

namespace app\models;

use yii\db\ActiveRecord;

class Currency extends ActiveRecord
{
    public static function tableName()
    {
        return 'currency';
    }

    public function rules()
    {
        return [
            [['code', 'date'], 'required'],
            [['code'], 'string', 'max' => 3],
            [['date'], 'safe'],
            [['rate'], 'number'],
        ];
    }
}
