<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['rememberMe', 'boolean'],
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'rememberMe' => 'Запомнить',
            'password' => 'Пароль',
        ];
    }
    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
 
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверное имя пользователя или пароль.');
            } elseif ($user && $user->status == User::STATUS_BANNED) {
                $this->addError('username', 'Ваш аккаунт заблокирован.');
            } elseif ($user && $user->status == User::STATUS_INACTIVE) {
                $this->addError('username', 'Ваш аккаунт не подтвежден.');
            }
        }
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 365 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsermail($this->email);
        }

        return $this->_user;
    }
  
}
