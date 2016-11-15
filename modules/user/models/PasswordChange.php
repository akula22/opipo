<?php
namespace app\modules\user\models;

use app\modules\user\models\User;
use yii\base\Model;
use Yii;


class PasswordChange extends Model
{
    public $new_password;
    public $current_password;

    private $_user;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['new_password', 'string', 'min' => 6, 'max' => 30],
            [['new_password', 'current_password'], 'required'],
            [['new_password', 'current_password'], 'trim'],
            ['new_password', 'compare', 'compareAttribute' => 'current_password', 'operator' => '!=='],
            ['current_password', 'validateCurentPassword'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'new_password' => Yii::t('main', 'New password'),
            'current_password' => Yii::t('main', 'Current password'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     */
    public function validateCurentPassword ($attribute, $params)
    {
        $user = $this->user;

        if (!$user || !$user->validatePassword($this->$attribute)) 
        {
            $this->addError($attribute, 'Текущий пароль не верен!');
        }
    }

    /**
     * Change user password.
     *
     * @return boolean true if password was successfully changed
     */
    public function password()
    {
        if (($model = $this->user) !== null) 
        {
            $model->setPassword($this->new_password);
            if($model->save())
            {
                 return true;
            }
        }
        return false;
    }

    /**
     * Finds user by id.
     *
     * @return User|null User instance
     */
    protected function getUser()
    {
        if ($this->_user === null) 
        {
            $this->_user = User::findOne(Yii::$app->user->id);
        }
        return $this->_user;
    }
}
