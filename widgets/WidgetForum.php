<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;





class WidgetForum extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        // $post = Yii::$app->cache->get('post')
        $post = '';

        return $this->render(
        	'widgetForum', ['post' => $post]
        	);
    }   
}