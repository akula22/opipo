<?php 
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\bootstrap\Tabs;
    use yii\widgets\DetailView;

    $this->title = Yii::t('main', 'Profile');
   
    $this->params['breadcrumbs'][] = '';
    $this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Users'), 'url' => ['/user/default/index']];
    $this->params['breadcrumbs'][] = $model->username;

    echo $this->render('/profile/_header', ['model' => $model]);
?>


<?php
    $detailView = '<div style="padding-top:10px"></div>';
    $detailView .= \yii\widgets\DetailView::widget([
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
            // 'email:html',
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


<!--   Вывод меню  -->

<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('main', 'Info'),
            'content' => $detailView,
            'active' => true
        ],
        [
            'label' => 'Статистика',
            'content' => $this->render('/profile/_stat', ['model' => $model]),
        ],
        [
            'label' => 'Разное',
            'content' => $this->render('/profile/_misc', ['model' => $model]),
        ],
        
    ],
]);