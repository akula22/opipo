<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;





class WidgetNews extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $post = Yii::$app->cache->get('post');

        return $this->render('widgetNews', ['post' => $post]);
    }   
}