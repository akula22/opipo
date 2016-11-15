<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;

class WidgetLanguage extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        return $this->render('widgetLanguage', [
                'locales' => array_keys(Yii::$app->params['locales'])
            ]);
    }
}

