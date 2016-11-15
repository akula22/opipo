<?php

namespace app\modules\paper2\models;

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
        return '{{%paper2}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    { 
        return [
            [['position', 'min_price', 'price', 'size'], 'integer'],
            [['title', 'min_price', 'price', 'size'], 'required'],
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
            'size' => 'Размер',
            'price' => 'Цена',
            'min_price' => 'Минимальная цена',
        ]; 
    } 

    public function beforeSave($insert)
    {
        
        return parent::beforeSave($insert);
    }

}
