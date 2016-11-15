<?php

namespace app\modules\site\controllers;
use Yii;
use yii\web\Controller;
use app\modules\site\models\Calc;
use app\modules\site\models\Calc2;
use app\modules\site\models\Calc3;

class DefaultController extends Controller
{
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
	
    public function actionIndex()
    {
        $model = new Calc();
        $settings = Yii::$app->cache->get('settings');

        if ($model->load(Yii::$app->request->post())) 
        {
            Yii::$app->session->setFlash('success', 'Успешно');
            // $model->save();
            // return $this->redirect('index');
        }
        return $this->render('index', ['model' => $model, 'settings' => $settings]);
    }

    public function actionPhotoprint()
    {
        $model = new Calc2();
        
        return $this->render('photoprint', [
            'model' => $model, 
            // 'settings' => $settings
            ]);
    }
    public function actionLargeformat()
    {
        $model = new Calc3();
        
        return $this->render('largeformat', [
            'model' => $model, 
            ]);
    }
   

    public function actionGetpaper()
    {
        if(Yii::$app->request->post('id') !== null)
        {
            $id = Yii::$app->request->post('id');
            $model = \app\modules\paper\models\Paper::findOne($id);
            echo json_encode(['price' => $model->price, 'percent' => $model->percent, 'width' => $model->width, 'height' => $model->height]);
        } 
    }

    public function actionGetpaper2()
    {
        if(Yii::$app->request->post('id') !== null)
        {
            $id = Yii::$app->request->post('id');
            $model = \app\modules\paper2\models\Paper::findOne($id);
            echo json_encode(['price' => $model->price, 'size' => $model->size, 'min_price' => $model->min_price]);
        } 
    }

    public function actionGetpaper3()
    {
        if(Yii::$app->request->post('id') !== null)
        {
            $id = Yii::$app->request->post('id');
            $model = \app\modules\paper3\models\Paper::findOne($id);
            echo json_encode(['price' => $model->price]);
        } 
    }


}
