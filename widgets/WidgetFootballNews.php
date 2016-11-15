<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class WidgetFootballNews extends Widget
{
    public $limit = 5; # кол-во новостей на странице

    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        $footballNews = simplexml_load_string(Yii::$app->cache->get('footballNews'));

        $array = [];
      
        $n = 1;

        if($footballNews) foreach ($footballNews->channel->item as $item) 
        {
            $link = str_replace('http://football.kulichki.net', '', $item->link);
            $link = str_replace(['/rusnews/news.htm?', '/worldnews/news.htm?'], '', trim($link));
            $id = (int)$link;
           
            $array[$n]['id'] = $id;
            $array[$n]['title'] = $item->title;
            $array[$n]['description'] = $item->description;
            
            if($n >= $this->limit) 
                break;
            $n++;
        }

        return $this->render('widgetFootballNews', [
                'footballNews' => $array
            ]);
    }
}

