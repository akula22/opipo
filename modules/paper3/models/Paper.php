<?php

namespace app\modules\paper3\models;

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
        return '{{%paper3}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() 
    { 
        return [
            [['position', 'price'], 'integer'],
            [['title', 'price'], 'required'],
            [['title'], 'string', 'max' => 255],
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
          
            'price' => 'Цена',
          
        ]; 
    } 

    public function beforeSave($insert)
    {
        
        return parent::beforeSave($insert);
    }

}
