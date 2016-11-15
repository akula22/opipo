<?php

namespace app\modules\paper2\controllers;

use Yii;
use yii\web\Controller;
use app\modules\paper2\models\Paper;
use app\modules\paper2\models\PaperSearch;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\HttpException;
use himiklab\sortablegrid\SortableGridAction;


/**
 * BackendController implements the CRUD actions for Post model.
 */
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

    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => Paper::className(),
            ],
        ];
    }



    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PaperSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Paper();

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->save();
            return $this->redirect('index');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {

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
            return $this->redirect(['index']);
        } else {
            throw new HttpException(400);
        }
    }

    
    protected function findModel($id)
    {
        if (is_array($id)) {
            $model = Paper::findAll($id);
        } else {
            $model = Paper::findOne($id);
        }
        if ($model !== null) {
            return $model;
        } else {
            throw new HttpException(404);
        }
    }
}
