<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\modules\user\commands;

use yii\console\Controller;
use app\modules\user\models\User;
use yii\base\Model;
use yii\console\Exception;
use yii\helpers\Console;



/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class UsersController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex()
    {
        echo 'yii users/create' . PHP_EOL;
        echo 'yii users/delete' . PHP_EOL;

    }

    public function actionCreate()
    {
        $model = new User();
        $this->readValue($model, 'username');
        $this->readValue($model, 'email');
        $this->readValue($model, 'role');
        $model->setPassword($this->prompt('Password:', [
            'required' => true,
            'pattern' => '#^.{2,255}$#i',
            'error' => 'More than 2 symbols',
        ]));
        $model->generateAuthKey();
        $this->log($model->save());
    }

    public function actionCreateauto()
    {
        $col = $this->prompt('How many users?: ');
        for($i = 0; $i <= $col; $i++)
        {
            $model = new User();
            $model->username = 'robot_' . \Yii::$app->security->generateRandomString(5);
            $model->email = \Yii::$app->security->generateRandomString(5) . '@mail.ru';
            $model->role = 'user';
            $model->setPassword('88');
            $model->generateAuthKey();
            $this->log($model->save(), $model->username);
            

            //  Отправляем в лог
            \app\modules\log\models\Log::addLog(
                [
                    'category' => 'user',
                    'event' => 'Зарегистрирован новый пользователь: ' . $model->username,
                    'username' => $model->username,
                    'user_id' => $model->getId(),
                ]
            );
        }
    }


    private function readValue($model, $attribute)
    {
        $model->$attribute = $this->prompt(mb_convert_case($attribute, MB_CASE_TITLE, 'utf-8') . ':', [
            'validator' => function ($input, &$error) use ($model, $attribute) {
                $model->$attribute = $input;
                if ($model->validate([$attribute])) {
                    return true;
                } else {
                    $error = implode(',', $model->getErrors($attribute));
                    return false;
                }
            },
        ]);
    }

    private function log($success, $text)
    {
        if ($success) 
        {
            $this->stdout('Success! ' . $text, Console::FG_GREEN, Console::BOLD);
        } else {
            $this->stderr('Error!', Console::FG_RED, Console::BOLD);
        }
        echo PHP_EOL;
    }
 

}
