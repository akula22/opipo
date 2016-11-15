<?php
namespace app\modules\user\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use yii\helpers\ArrayHelper;


class User extends ActiveRecord implements IdentityInterface
{
    public $password;
	/**
	 * Статусы пользователей.
	 */
	const STATUS_INACTIVE 	= 0;
	const STATUS_ACTIVE 	= 1;
	const STATUS_BANNED 	= 2;

    public static function getStatusArray()
    {
        return [
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_INACTIVE => 'Неактивен',
            self::STATUS_BANNED => 'Забанен',
        ];
    }

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusArray(), $this->status);
    }


	public static function tableName()
    {
        return '{{%user}}';
    }

    public function behaviors()
    {
        return [
            \yii\behaviors\TimestampBehavior::className(),
        ];
    }


    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => self::className(), 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 100],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => self::className(), 'message' => 'This email address has already been taken.'],

            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => array_keys(self::getStatusArray())],

            ['role', 'default', 'value' => Yii::$app->authManager->getRole('user')->name],
            ['role', 'in', 'range' => array_keys(self::getRoleArray())],
        ];
    }


    public function attributeLabels() 
    { 
        return [ 
           'created_at' => Yii::t('main', 'Created_at'),
           'updated_at' => Yii::t('main', 'Updated_at'),
           'status' => Yii::t('main', 'Status'),
           'username' => Yii::t('main', 'Username'),
           'role' => Yii::t('main', 'Role'),
           'id' => '#ID',
        ]; 
    } 
    

    /**
	 * Идентификация.
	 */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Finds user by usermail
     */
    public static function findByUsermail($email)
    {
        return static::findOne(['email' => $email]);
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->generateAuthKey();
            }
            return true;
        }
        return false;
    }







    /**
     * Finds user by password reset token
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = 3600;
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }


    /**
    *   Акутивация email
    */
    public static function findByEmailConfirmToken($email_confirm_token)
    {
        return static::findOne(['email_confirm_token' => $email_confirm_token, 'status' => self::STATUS_INACTIVE]);
    }
    public function generateEmailConfirmToken()
    {
        $this->email_confirm_token = Yii::$app->security->generateRandomString();
    }
    public function removeEmailConfirmToken()
    {
        $this->email_confirm_token = null;
    }








    public static function getRoleArray()
    {
        return ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description');
    }

    public function getProfile()
    {
        return $this->hasOne(\app\modules\user\models\Profile::className(), ['user_id' => 'id']);
    }

    public static function getViewProfile($username)
    {
        $model = self::find()->with('profile')->where(['username' => $username])->one();
        return $model;
    }




}