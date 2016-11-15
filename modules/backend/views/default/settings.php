<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = 'Настройки сайта';
    $this->params['breadcrumbs'][] = $this->title;
?>

<div>
   <?php $form = ActiveForm::begin(
	['id' => 'site-settings-form'],
	['enableClientValidation' => false],
	['enableAjaxValidation' => true],
	['validateOnChange' => false]
	); 
	?>
	
	<?= $form->field($model, 'priceRun') ?>
	<?= $form->field($model, 'pricePrintingPlate') ?>
	<?= $form->field($model, 'indent') ?>
	<div style="border-bottom:1px solid #dedede">&nbsp;</div><br />
	<?= $form->field($model, 'adminEmail') ?>
	<?= $form->field($model, 'phone')->textArea(['rows' => 3]); ?>

	<?= $form->field($model, 'title'); ?>
	<?= $form->field($model, 'keywords'); ?>
	<?= $form->field($model, 'description')->textArea(['rows' => 4]); ?>

	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>

	<?php ActiveForm::end(); ?>
</div>
