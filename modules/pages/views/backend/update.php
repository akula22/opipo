<?php
	use yii\helpers\Html;
	$this->title = 'Редактирование страницы';
    $this->params['breadcrumbs'][] = $this->title;
?>

<div class="">
    <?php echo $this->render('_form', [
	'model' => $model,
	]);?>
</div>
