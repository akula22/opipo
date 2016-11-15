<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use app\modules\user\models\SignupForm;
// use app\modules\user\models\LoginForm;
use app\modules\user\models\LoginByEmail;
use app\modules\user\models\recover\RecoverPassword;
use app\modules\user\models\recover\ResetPassword;
use yii\filters\AccessControl;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;
use app\modules\user\models\Auth;
use app\modules\user\models\User;
use app\modules\user\models\Profile;
use app\modules\user\models\recover\EmailConfirmForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;




class SignupController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],

            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@app/public_html/upload/tmp',
            ],
        ];
    }



    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->redirect(['/backend/pages/index']); 
        }

        $model = new LoginByEmail();
        
        if ($model->load(Yii::$app->request->post()) && $user = $model->login()) 
        {
            Yii::$app->getSession()->setFlash('success', 'Добро пожаловать!');
            return $this->redirect(['/backend/pages/index']); 
        } 
        else 
        {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /* Форма запроса и отправка Email*/
    public function actionRecover()
    {
        $model = new RecoverPassword();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) 
            {
                Yii::$app->getSession()->setFlash('success', 'Проверьте ваш email и следуйте дальнейшим инструкциям.');

                return $this->goHome();
            } 
            else 
            {
                Yii::$app->getSession()->setFlash('error', 'Извините, мы не можем отправить письмо на вашу почту.');
            }
        }

        return $this->render('recover', [
            'model' => $model,
        ]);
    }

    /* Проверка токкена, сброс пароля*/
    public function actionReset($token)
    {
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Новый пароль установлен.');
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionSignup()
    {
  
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post())) 
        {
            if ($user = $model->signup()) 
            {
                if($this->module->emailConfirm === true)
                {
                    Yii::$app->getSession()->setFlash('success', 'Подтвердите ваш электронный адрес.');
                    return $this->goHome();
                }
                 
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    //  подтверждение мыла
    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($user = $model->confirmEmail()) 
        {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');

            if (Yii::$app->getUser()->login($user)) 
            {
                //  Отправляем в лог
                \app\modules\log\models\Log::addLog(
                    [
                        'category' => 'user',
                        'event' => 'New user: ' . $user->username,
                        'user_id' => Yii::$app->user->id,
                        'username' => Yii::$app->user->identity->username,
                    ]
                );
                return $this->goHome();
            }
        } 
        else 
        {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }
 
        return $this->goHome();
    }



    #OAUTH
    public function onAuthSuccess($client)
    {
        $attributes = $client->getUserAttributes();
        
        $client_ = $client->getId();

        if($client_ == 'facebook') 
            $username = $attributes['name'];

        if($client_ == 'vkontakte') 
            $username = $attributes['screen_name'];

        if($client_ == 'yandex') 
        {
            $username = $attributes['login'];
            $attributes['email'] = $attributes['default_email'];
        }
           

        $user = User::find()->where([
                'client'=>$client->getName(),
                'client_id'=>ArrayHelper::getValue($attributes, 'id')
            ])->one();

        //  Если такой юзер есть, значит логиним его
        if ($user) 
        {
            if (Yii::$app->getUser()->login($user, true ? 3600 * 24 * 365 : 0)) 
            {
                return $this->redirect(Url::previous());
            }
        }

        //  Если такого юзера нет, значит создаем
        if (!$user) 
        {
            $user = new User();
            $user->username = $username;
            $user->email = ArrayHelper::getValue($attributes, 'email');
            $user->client = $client->getName();
            $user->client_id = ArrayHelper::getValue($attributes, 'id');
            $user->setPassword(Yii::$app->security->generateRandomString(8));

            $transaction = $user->getDb()->beginTransaction();
            if ($user->save()) 
            {
                // Сохраняем профиль
                $profile = new Profile();
                $profile->user_id = $user->id;
                if($profile->save())
                {
                    $transaction->commit();
                    Yii::$app->user->login($user);
                    //  Отправляем в лог
                    \app\modules\log\models\Log::addLog(
                        [
                            'category' => 'user',
                            'event' => 'New user: ' . $user->username,
                            'user_id' => Yii::$app->user->id,
                            'username' => Yii::$app->user->identity->username,
                        ]
                    );
                    return $this->redirect(Url::previous());
                }
                else
                {
                    \Yii::$app->VarDumper->dump($profile->getErrors()); die();
                }
            }
            else
            {
                \Yii::$app->VarDumper->dump($user->getErrors()); die();
            }
        }
    }




 
}
