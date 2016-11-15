<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace app\components;

use yii\base\Action;
use yii\base\InvalidParamException;


class SetLocale extends Action
{
    public $locales;
    public $localeSessionKey = 'user.locale';
    public $callback;



    public function run($locale)
    {
        // file_put_contents('11111111.txt', $locale);
        if(is_array($this->locales) && !in_array($locale, $this->locales)){
            throw new InvalidParamException('Unacceptable locale');
        }
        \Yii::$app->session->set($this->localeSessionKey, $locale);
        if($this->callback && $this->callback instanceof \Closure){
            return call_user_func_array($this->callback, [
                $this,
                $locale
            ]);
        }
        return \Yii::$app->response->redirect(\Yii::$app->request->referrer ?: \Yii::$app->homeUrl);
    }
} 