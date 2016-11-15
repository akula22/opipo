<?php
namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\pm\models\Pm;


class WidgetLogin extends Widget
{
    public function init()
    {
        parent::init();
    }
    
    public function run()
    {
        //  Есть ли не прочитанные сообщения
        $newMessage = Pm::find()->where(['status' => Pm::STATUS_UNREAD , 'user_id' => Yii::$app->user->id])->count();

        return $this->render('widgetLogin', [
            'newMessage' => $newMessage,
        ]);
       
    }
}