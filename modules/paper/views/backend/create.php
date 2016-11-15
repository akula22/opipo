<?php
	use yii\helpers\Html;
	$this->title = 'Создание бумаги';
	$this->params['breadcrumbs'][] = ['label' => 'Список бумаг', 'url' => 'index'];
    $this->params['breadcrumbs'][] = $this->title;
?>


<div class="post-create">
    <?php echo $this->render('_form', [
	'model' => $model,
	]);?>
</div>
