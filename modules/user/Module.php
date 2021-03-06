<?php

namespace app\modules\user;

use Yii;
use yii\console\Application as ConsoleApplication;


class Module extends \yii\base\Module
{
    public $controllerNamespace = 'app\modules\user\controllers';

    public $emailConfirm = true;

    public function init()
    {
        parent::init();

        if (Yii::$app instanceof ConsoleApplication) 
        {
            $this->controllerNamespace = 'app\modules\user\commands';
        }
    }
}
