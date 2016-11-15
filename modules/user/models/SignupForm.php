<?php
namespace app\modules\user\models;

use Yii;
use yii\base\Model;
use app\modules\user\models\User;
use app\modules\user\models\Profile;
use app\modules\user\Module;
use yii\base\InvalidParamException;



/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $repassword;
    public $firstname;
    public $lastname;
    public $avatar;
    public $captcha;

    protected $module;

    public function __construct()
    {
        $this->module = Yii::$app->getModule('user');
    }


    public function rules()
    {
        return [
            // required
            [['username', 'email', 'password', 'repassword'], 'required'],

            // trim
            [['username', 'email', 'password', 'repassword'], 'filter', 'filter' => 'trim'],

            // unique
            [['username', 'email'], 'unique', 'targetClass' => User::className()],

            // username
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/'],
            ['username', 'string', 'min' => 2, 'max' => 100],

            // email
            ['email', 'email'],
            ['email', 'string', 'max' => 100],

            // password
            [['password', 'repassword'], 'string', 'min' => 6, 'max' => 30],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
            
            // firstname
            [['firstname', 'lastname'], 'string', 'min' => 2, 'max' => 100],

            // avatar
            ['avatar', 'string', 'max' => 200],

            //  captcha
            // ['captcha',
            // 'Zelenin\yii\widgets\Recaptcha\validators\RecaptchaValidator',
            // 'secret' => '6LeNjRUTAAAAALO9EODPsO0gRX-d3dulbfxuEbdc'],
        ];
    }


    public function attributeLabels()
    {
        return [
           
            'password' => \Yii::t('main', 'Password'),
            'repassword' => \Yii::t('main', 'Repassword'),
            'captcha' => \Yii::t('main', 'VerifyCode'),
            'firstname' => \Yii::t('main', 'Firstname'),
            'lastname' => \Yii::t('main', 'Lastname'),
            'avatar' => \Yii::t('main', 'Avatar'),
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) 
        {
            $user = new User();
            $profile = new Profile();

            $user->username = $this->username;
            $user->email = $this->email;
            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->status = $this->module->emailConfirm ? User::STATUS_INACTIVE : User::STATUS_ACTIVE;
            $this->module->emailConfirm ? $user->generateEmailConfirmToken() : false;
            $profile->firstname = $this->firstname;
            $profile->lastname = $this->lastname;
            $profile->avatar = $this->avatar;

            $transaction = Yii::$app->db->beginTransaction();
            if ($user->save()) 
            {
                $profile->user_id = $user->getId();
                if($profile->save())
                {
                    $transaction->commit();

                    if($this->module->emailConfirm === true)
                    {
                         Yii::$app->mailer->compose('@app/modules/user/mails/emailConfirm', ['user' => $user])
                        ->setFrom([Yii::$app->params['email']['robot'] => Yii::$app->name])
                        ->setTo($this->email)
                        ->setSubject('Email confirmation for ' . Yii::$app->name)
                        ->send();
                    }

                    return $user;
                }
               
            }
            else
            {
                $transaction->rollback();
                \Yii::$app->VarDumper->dump($user->getErrors()); die();
                return false;
            }
            
        }
        return null;
    }
}
