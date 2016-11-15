<?php
	use yii\helpers\Html;
	use yii\widgets\DetailView;

	$this->title = 'Просмотр страницы';
    $this->params['breadcrumbs'][] = $this->title;
?>


<div class="">
	   <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

  	<?php
  		echo DetailView::widget([
	'model' => $model,
	'attributes' => [
	    'id',
	    'title',
        'alias',
        'full:html',
	    [
	        'attribute' => 'created_at',
	        'format' => ['date', 'd.m.Y H:i']
	    ],
        [
            'attribute' => 'updated_at',
            'format' => ['date', 'd.m.Y H:i']
        ]
	]
]);
  	?>
</div>
