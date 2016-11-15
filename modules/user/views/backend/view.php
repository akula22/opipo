<?php
	use yii\helpers\Html;
	use yii\widgets\DetailView;

	$this->title = 'Просмотр пользователя ' . $model->username;
    
    $this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $model->username;
    
?>

<div class="user-view">

    <p>
        <?php echo Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php echo Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены что хотите его удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

  	<?php
  		echo DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'id',
	    'username',
        'role',
        [
            'attribute' => 'client_id',
            'value' => $model->client . ' id:' . $model->client_id
        ],
        'email',
        [
            'attribute' => 'status',
            'value' => $model->statusName
        ],
	    [
            'attribute' => 'created_at',
            'format' => ['date', 'dd.MM.yyyy HH:mm'],
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['date', 'dd.MM.yyyy HH:mm'],
        ],
	   
	]
]);
  	?>
</div>
