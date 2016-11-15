<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\user\models\SearchUser $searchModel
 */

$this->title = 'Список страниц';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <p>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

   <?= GridView::widget([
        'id' => 'pages-grid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

             // ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'options' => array('width'=>'50px'),
            ],

            [
                'attribute' => 'title',
                'format' => 'html',
                
                'value' => function ($model) {
                    return Html::a($model['title'], ['update', 'id' => $model['id']]);
                }
            ],
            [
                'attribute' => 'alias',
                'format' => 'url',
                'value' => function ($model) {
                    return \yii\helpers\Url::To('@web/page/'.$model->alias, true);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.yyyy'],
                'options' => array('width'=>'225px'),
                'filter' => \yii\jui\DatePicker::widget(
                    [
                        'dateFormat' => 'dd.MM.yyyy',
                        'model' => $searchModel,
                        'attribute' => 'created_at',
                        'options' => [
                            'class' => 'form-control'
                    ],
                    'clientOptions' => [
                        'dateFormat' => 'dd.mm.yy',
                        ]
                    ]
                )
            ],
           
            [
                'class' => 'yii\grid\ActionColumn',
                 // 'header' => 'Управление',
            ],
        ],
    ]); ?>
</div>

