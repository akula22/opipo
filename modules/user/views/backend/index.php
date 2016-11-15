<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\user\models\User;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\widgets\Pjax;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\modules\user\models\SearchUser $searchModel
 */

$this->title = 'Список пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="user-index">

    <p>
        <?= Html::a('Создать пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <? Pjax::begin() ?>
    <?= GridView::widget([
        'id' => 'user_tbl',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => CheckboxColumn::classname()
            ],
            [
                'attribute' => 'id',
                'options' => array('width'=>'50px'),
            ],

            [
                'attribute' => 'username',
                'format' => 'html',
                
                'value' => function ($model) {
                    return Html::a($model['username'], ['/user/' . $model['username']]);
                }
            ],

            'email:email',
            
            [
                'attribute' => 'created_at',
                'format' => ['date', 'dd.MM.yyyy HH:mm'],
                'options' => array('width'=>'150px'),
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
                'attribute' => 'role',
                'options' => array('width'=>'150px'),
                'filter' => Html::activeDropDownList($searchModel, 'role', $roleArray, ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            [
                'attribute' => 'status',
                'options' => array('width'=>'150px'),
                'value' => function ($model) {
                    return $model->statusName;
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', $statusArray, ['class' => 'form-control', 'prompt' => 'Все']),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p> 
    <?= Html::a('Удалить выбранные', ['massdelete'], [ 
        'class' => 'btn btn-danger', 
        'data' => [ 
            'confirm' => 'Вы уверены?', 
            'data-method' => 'post',
       ], 
    ]) ?>  
    </p>
    </div>


<? Pjax::end();?>

<?php
$js = "$('.btn').on('click', function() 
    {
        $.post(
            \"massdelete\", {
                selection : $('#user_tbl').yiiGridView('getSelectedRows')
            },
            function () {
                $.pjax.reload({container:'#w0-container'});
            }
        )
    }
)";
$this->registerJs($js, $this::POS_READY);
?>
