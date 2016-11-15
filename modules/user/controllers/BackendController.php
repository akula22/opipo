<?php

namespace app\modules\user\controllers;

use Yii;
use yii\web\Controller;
use app\modules\user\models\User;
use app\modules\user\models\Profile;
use app\modules\user\models\Auth;
use app\modules\user\models\SearchUser;
use app\modules\user\models\SettingsUser;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\HttpException;

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
        $searchModel = new SearchUser;
        $dataProvider = $searchModel->search(Yii::$app->request->get());
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'statusArray' => $statusArray,
            'roleArray' => $roleArray 
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => User::findOne($id),
        ]);
    }

    public function actionCreate()
    {
    	$user = new User();
        $profile = new Profile();

    	$statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if ($user->load(Yii::$app->request->post())) 
        {
            if ($user->validate()) 
            {
                $transaction = Yii::$app->db->beginTransaction();
                if ($user->save(false)) 
                {
                    $profile->user_id = $user->getId();
                    if($profile->save(false))
                    {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                    else
                    {
                        $transaction->rollback();
                        print_r($user->getErrors());
                        return false;                        
                    }
                } 
                else 
                {
                    Yii::$app->session->setFlash('danger', 'Ошибка');
                    return $this->refresh();
                }
            } 
        }
				
        return $this->render('create', ['model' => $user, 'statusArray' => $statusArray, 'roleArray' => $roleArray]);
    }

    public function actionUpdate($id)
    {
        $model = User::findOne($id);
        $statusArray = User::getStatusArray();
        $roleArray = User::getRoleArray();

        if($model->load(Yii::$app->request->post()) && $model->save()) 
            return $this->redirect(['index']);

        return $this->render('update', ['model' => $model, 'statusArray' => $statusArray, 'roleArray' => $roleArray]);
    }

    public function actionDelete($id)
    {
        $profileModel = Profile::findOne(['user_id' => $id]);
        $profileModel->delete();

        $authModel = Auth::findOne(['user_id' => $id]);
        if($authModel)
            $authModel->delete();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionMassdelete()
    {
        if (($ids = Yii::$app->request->post('selection')) !== null) {
            $models = $this->findModel(Yii::$app->request->post('selection'));
            foreach ($models as $model) {
                $model->delete();
            }

            $models = Profile::findAll(Yii::$app->request->post('selection'));
            foreach ($models as $model) {
                $model->delete();
            }

             $models = Auth::findAll(Yii::$app->request->post('selection'));
            foreach ($models as $model) {
                $model->delete();
            }
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }
    protected function findModel($id)
    {
        if (is_array($id)) {
            $model = User::findAll($id);
        } else {
            $model = User::findOne($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }
}
