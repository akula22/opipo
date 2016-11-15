<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use app\modules\user\models\User;
use app\modules\user\models\Test;
use app\modules\user\models\Profile;
use app\modules\user\models\PasswordChange;
use vova07\fileapi\actions\UploadAction as FileAPIUpload;

class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'fileapi-upload' => [
                'class' => FileAPIUpload::className(),
                'path' => '@app/public_html/upload/tmp',
            ],
        ];
    }

    public function actionTest()
    {
        $model = new Test();
        if ($model->load(Yii::$app->request->post())) 
        {
            \Yii::$app->VarDumper->dump($model); die();
        }

        return $this->render('test', [
            'model' => $model,
        ]);
    }


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['status' => User::STATUS_ACTIVE]),
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => [
                'pageSize' => 10
            ],
        ]);



        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($username)
    {
        $model = User::getViewProfile($username);

        if($model === null)
            throw new \yii\web\HttpException(404, 'User not be found.');

        return $this->render('view', ['model' => $model]);
    }

    


    public function actionProfile()  
    {
        $model = Profile::findOne(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post())) 
        {
            if ($model->validate()) 
            {
                if ($model->save(false)) 
                {
                    Yii::$app->session->setFlash('success', Yii::t('main', 'Successfully'));
                } else 
                {
                    Yii::$app->session->setFlash('danger', Yii::t('main', 'Error'));
                }
                return $this->refresh();
            } 
        }

        $user = new PasswordChange();
        $active = ['profile' => '', 'pwd' => ''];

        if ($user->load(Yii::$app->request->post())) 
        {
            if(!empty(Yii::$app->request->post('PasswordChange')))
            {
                $active['profile'] = false;
                $active['pwd'] = true;
            }
            else
            {
                $active['profile'] = true;
                $active['pwd'] = false;
            }

            if ($user->validate()) 
            {
                if ($user->password())
                {
                    Yii::$app->session->setFlash('success', 'Пароль успешно изменен.');
                    return $this->goHome();
                }
                else
                {
                    Yii::$app->session->setFlash('danger', 'Пароль не может быть изменен.');
                    return $this->refresh();
                }
            }
        }

        return $this->render(
            'profile',
            [
                'model' => $model,
                'user' => $user,
                'active' => $active,
            ]
        );
    }

}
