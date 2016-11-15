<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;



class WidgetLastMatches extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        

        return $this->render('widgetLastMatches', [
            // 'newMessage' => $newMessage,
        ]);
       
    }
}