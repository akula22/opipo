<?php

namespace app\modules\pages\controllers;

use yii\web\Controller;
use app\modules\pages\models\Pages;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class DefaultController extends Controller
{
    

    public function actionView($alias)
    {
        $model = Pages::findOne(['alias' => $alias]);

        if($model !== null)
            return $this->render('view', [
            'model' => $model ]);
        else
            throw new NotFoundHttpException('The requested post does not exist.');
    }
}
