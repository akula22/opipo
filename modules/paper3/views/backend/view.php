<?php

use yii\helpers\Html; 
use yii\widgets\DetailView; 

/* @var $this yii\web\View */ 
/* @var $model app\modules\post\models\Post */ 

$this->title = $model->title; 
$this->params['breadcrumbs'][] = ['label' => 'бумага', 'url' => ['index']]; 
$this->params['breadcrumbs'][] = $this->title; 
?> 

  <div class="post-view">

    <p> 
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> 
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [ 
            'class' => 'btn btn-danger', 
            'data' => [ 
                'confirm' => 'Вы уверены?', 
                'method' => 'post', 
            ], 
        ]) ?> 
    </p> 

    <?= DetailView::widget([ 
        'model' => $model, 
        'attributes' => [ 
            'id',
           
           
            'title',
            'price',
        ], 
    ]) ?> 

</div> 