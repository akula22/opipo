<?php

namespace app\modules\pages\controllers;

use Yii;
use yii\web\Controller;
use app\modules\pages\models\Pages;
use app\modules\pages\models\SearchPages;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use app\components\Helper;


class BackendController extends Controller
{
    public $layout ='@app/modules/backend/views/layouts/main';


	public function behaviors()
    {
        return [
           'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['index', 'view'],
                        'allow' => true,
                        'roles' => ['moder'],
                    ],
                ],

            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SearchPages;
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Pages::findOne($id),
        ]);
    }

    public function actionCreate()
    {
    	$model = new Pages();

    	if($model->load(Yii::$app->request->post()))
        {
            if($model->save())
            {
                Yii::$app->getSession()->setFlash('success', 'Страница успешно добавлена.');
                return $this->redirect(['index']); 
            }
        }
		
        return $this->render('create', [
        	'model' => $model, 
        ]);
    }

    public function actionUpdate($id)
    {
        $model = Pages::findOne($id);

        if($model->load(Yii::$app->request->post()) && $model->save())
        {
            Yii::$app->getSession()->setFlash('success', 'Страница успешно изменена.');
            return $this->redirect(['index']);
        } 

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        Pages::findOne($id)->delete();
        Yii::$app->getSession()->setFlash('success', 'Страница успешно удалена.');
        return $this->redirect(['index']);
    }
}