<?php

namespace app\modules\paper\models;

use Yii;
use yii\db\ActiveRecord;
use himiklab\sortablegrid\SortableGridBehavior;




class Paper extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'sort' => [
                'class' => SortableGridBehavior::className(),
                'sortableAttribute' => 'position'
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%paper}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    { 
        return [
            [['position', 'percent', 'price', 'width', 'height'], 'integer'],
            [['title', 'percent', 'price', 'width', 'height'], 'required'],
            [['title'], 'string', 'max' => 200],
        ]; 
    } 

    /** 
     * @inheritdoc 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'id' => 'ID',
            'title' => 'Название',
            'percent' => 'Процент',
            'price' => 'Цена',
            'width' => 'Ширина',
            'height' => 'Высота',
        ]; 
    } 

    public function beforeSave($insert)
    {
        
        return parent::beforeSave($insert);
    }

}
