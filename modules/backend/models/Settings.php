<?php
namespace app\modules\backend\models;

use Yii;
use yii\base\Model;

class Settings extends Model
{
    public $adminEmail;
    public $phone;
    public $title;
    public $keywords;
    public $description;
    public $priceRun;
    public $pricePrintingPlate;
    public $indent;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['adminEmail', 'supportEmail'], 'required'],
            [['adminEmail'], 'email'],
            [['priceRun', 'pricePrintingPlate', 'indent'], 'integer'],
            [['title', 'keywords', 'description', 'phone'], 'string', 'max' => 200],
        ];
    }

    public function attributeLabels()
    {
        return [
            'adminEmail' => 'Email администратора',
            'phone' => 'Телефон',
            'title' => 'Заголовок сайта (title)',
            'keywords' => 'Ключевые слова (keywords)',
            'description' => 'Описание сайта (description)',
            'priceRun' => 'Цена прогона',
            'pricePrintingPlate' => 'Цена печатной формы',
            'indent' => 'Отступы',
        ];
    }

}