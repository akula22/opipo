<?php

namespace app\modules\site\models;

use Yii;
use yii\db\ActiveRecord;

class Calc2 extends \yii\db\ActiveRecord
{
    public $width;  
    public $height;  
    public $paper;
    public $numberPaper;
    public $format;
    public $unit;

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
            // [['width', 'height'], 'integer', 'max' => 1000],
            [['numberPaper'], 'integer', 'min' => 1, 'max' => 999999],
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
            'unit' => 'Ед. измерения',
            'format' => 'Формат бумаги'
        ];
    }


   
}
