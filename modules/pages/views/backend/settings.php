<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = 'Настройки пользователей';
    $this->params['breadcrumbs'][] = $this->title;
?>


<div class="">
   <?php $form = ActiveForm::begin(
	['id' => 'user-settings-form'],
	['enableClientValidation' => false],
	['enableAjaxValidation' => true],
	['validateOnChange' => false]
	); 
	?>
	
	<?= $form->field($model, 'auth')
        ->dropDownList(
            ['login' => 'Login + password', 'email' => 'Email + password'],           // Flat array ('id'=>'label')
            ['prompt'=>'Выберите метод авторизации пользователей']    // options
        );?>

	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>

	<?php ActiveForm::end(); ?>
</div>
