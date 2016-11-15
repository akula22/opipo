<?php

namespace app\modules\site;
use Yii;


class Module extends \yii\base\Module
{
	// $settings = Yii::$app->cache->get('settings');
	// public $pageTitle = $settings['title'];
	// public $description = $settings['description'];
	// public $keywords = $settings['keywords'];

    public $controllerNamespace = 'app\modules\site\controllers';

    public function init()
    {
        parent::init();
    }
}
