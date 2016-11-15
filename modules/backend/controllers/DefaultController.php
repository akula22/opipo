<?php

namespace app\modules\backend\controllers;

use Yii;
use yii\web\Controller;
use app\modules\backend\models\Settings;
use yii\filters\AccessControl;
use app\modules\user\models\User;

class DefaultController extends Controller
{
	
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin', 'moder'],
                    ],
                    [
                        'actions' => ['settings'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],

            ],
            // 'verbs' => [
            //     'class' => VerbFilter::className(),
            //     'actions' => [
            //         'logout' => ['post'],
            //     ],
            // ],
        ];
    }

    public function actionIndex()
    {
        // return $this->render('index');
        return $this->redirect(['/backend/paper/index']); 
    }



    public function actionSettings()
    {
    	$cache = Yii::$app->cache;
        $settings = $cache->get('settings');

        $model = new Settings();
        $model->setAttributes($settings);

        if($model->load(Yii::$app->request->post()))
        {
            $cache->set('settings', $model->getAttributes());
            Yii::$app->getSession()->setFlash('success', 'Настройки сохранены.');
            return $this->redirect(['/backend/settings']); 
        }
        else
        {
            return $this->render('settings', [
                'model' => $model,
            ]);
        }
    }
}
