<?php
	use yii\helpers\Html;
	$this->title = 'Создание пользователя';
	$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-create">
    <?php echo $this->render('_form', [
	'model' => $model,
	'statusArray' => $statusArray,
	'roleArray' => $roleArray,
	]);?>
</div>
