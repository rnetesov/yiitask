<?php

namespace app\models;

use yii\db\ActiveRecord;

class Order extends ActiveRecord
{
    public static function tableName()
    {
        return '{{order}}';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(), ['ID' => 'Customer_id']);
    }

    public function getPerformers()
    {
        return $this->hasMany(Performer::className(), ['Order' => 'ID']);
    }

    public function getLastPerformer()
    {
        return $this->hasMany(Performer::className(), ['Order' => 'ID'])
            ->orderBy('Date_appointment DESC')
            ->limit(1)->one();
    }

    public function rules()
    {
        return [
            [['Work_list', 'Date_from', 'Date_to', 'Price', 'Customer_id'], 'required'],
            ['Work_list', 'string', 'length' => ['10']],
            [['Date_from', 'Date_to'], 'datetime', 'format' => 'php:Y-m-d'],
            ['Price', 'number'],
            ['Customer_id', 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'Work_list' => 'Наименование работы',
            'Date_from' => 'Дата начала работ',
            'Date_to' => 'Дата окончания работ',
            'Price' => 'Цена работы'
        ];
    }
}