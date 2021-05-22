<?php


namespace app\models;


use yii\db\ActiveRecord;

class Performer extends ActiveRecord
{
    public static function tableName()
    {
        return '{{performer}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['ID' => 'User_id']);
    }

    public function rules()
    {
        return [
            [['Order', 'Date_appointment', 'User_id'], 'required'],
            [['Order', 'User_id'], 'integer'],
            ['Reason', 'trim'],
            ['Date_appointment', 'datetime', 'format' => 'php:Y-m-d H:i:s']
        ];
    }
}