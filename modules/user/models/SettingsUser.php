<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;

class SettingsUser extends Model
{
    public $auth;
    public $avatar;
    public $capcha;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['auth', 'required'],
            ['avatar', 'boolean'],
            ['capcha', 'boolean'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'auth' => 'Авторизация',
            // 'avatar' => 'Аватар при регистрации',
        ];
    }

}
