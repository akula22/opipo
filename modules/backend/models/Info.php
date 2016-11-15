<?php
namespace app\modules\backend\models;

use Yii;
use yii\base\Model;

class Info extends Model
{
    public function getNoActive($var)
    {
        $number = Yii::$app->cache->get($var);
        if($number == 0)
        {
            return '';
        }
        else
        {
            return $number;
        }
    }
}