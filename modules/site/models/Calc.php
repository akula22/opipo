<?php

namespace app\modules\site\models;

use Yii;
use yii\db\ActiveRecord;

class Calc extends \yii\db\ActiveRecord
{
    public $width;  
    public $height;  
    public $himself;
    public $paper;
    public $numberPaper;
    public $chromaticity;
    public $chromaticity2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'calc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['width', 'height'], 'required'],
            [['width', 'height'], 'integer', 'max' => 500],
            [['numberPaper'], 'integer', 'min' => 1, 'max' => 999999],
            [['himself', 'chromaticity', 'chromaticity2'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'width' => 'Ширина',
            'height' => 'Высота',
            'paper' => 'Бумага',
            'numberPaper' => 'Тираж',
            'chromaticity' => 'Цветность'
        ];
    }


    public function beforeSave($insert)
    {

        
        return parent::beforeSave($insert);
    }
}
