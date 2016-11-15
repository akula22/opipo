<?php
	use yii\helpers\Html;
	$this->title = 'Редактирование пользователя: ' . $model->username;
    $this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => 'index'];
    $this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-update">
    <?php echo $this->render('_form', [
	'model' => $model,
	'statusArray' => $statusArray,
	'roleArray' => $roleArray,
	]);?>
</div>
