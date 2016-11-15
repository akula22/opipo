<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\CheckboxColumn;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;



// use app\modules\post\models\PostSearch; 

/* @var $this yii\web\View */
/* @var $searchModel app\modules\post\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Бумага';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <p>
        <?= Html::a('Создать бумагу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <? Pjax::begin() ?>
    <?= himiklab\sortablegrid\SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'id' => 'post_tbl',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => CheckboxColumn::classname()
            ],
            [
                'attribute' => 'title',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a(
                        $model['title'],
                        ['update', 'id' => $model['id']]
                    );
                }
            ],
            'price',
            'min_price',
            [
                'attribute' => 'size',
                'value' => function ($model) {
                    return $model['size'] . ' mm';
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'header'=>'Действия', 
                'headerOptions' => ['width' => '100'],
            ],
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


<? Pjax::end();?>
</div>

<?php
$js = "$('.btn').on('click', function() 
    {
        $.post(
            \"massdelete\", {
                selection : $('#post_tbl').yiiGridView('getSelectedRows')
            },
            function () {
                $.pjax.reload({container:'#w0-container'});
            }
        )
    }
)";
$this->registerJs($js, $this::POS_READY);

?>
