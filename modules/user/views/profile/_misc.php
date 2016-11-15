<?php
use yii\widgets\DetailView;

echo \yii\widgets\DetailView::widget([
        'model' => $model,
        'attributes' => [
        	'id',
            'username',
            [
                'attribute' => created_at,
                'format' => ['date', 'dd.MM.yyyy HH:ss'],
            ],
            'profile.firstname',
            'profile.lastname',
            'email:html',
            'role',
            [
              'attribute' => 'profile.gender',
              'format' => 'html',
              'value' => $model->profile->gender == 2 ? '<i class="fa fa-male">' : '<i class="fa fa-female">',
            ],
            'profile.country',
            [
            	'attribute' => 'status',
            	'format' => 'html',
            	'value' => $model->status === 1 ? '<i class="fa fa-check"></i>' : '<i class="fa fa-lock">',
            ],
            //Yii::$app->formatter->asDate($comment->created_at, 'php:j M H:s')
        ],
    ]) 
?>