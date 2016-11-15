<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(
	['id' => 'user-form'],
	['enableClientValidation' => false],
	['enableAjaxValidation' => true],
	['validateOnChange' => false]
	); 
	?>

 	<?= $form->field($model, 'username') ?>
 	<?= $form->field($model, 'email') ?>
 	
 	<?php if($model->isNewRecord):?>
 		<?= $form->field($model, 'password')->passwordInput() ?>
 	<?php endif; ?>
 	
 	<?= $form->field($model, 'status')->dropDownList($statusArray,  
 						['options' =>
                            [
                                1 => ['selected ' => true]
                            ]
                        ]) ?>

 	<?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', 
 	['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>

<?php ActiveForm::end(); ?>


