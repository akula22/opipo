<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;

	$this->title = 'Настройки пользователей';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="header">
    <h1 class="page-title"><?= Html::encode($this->title); ?></h1>
</div>

<div class="well">
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

    <?= $form->field($model, 'avatar')->checkBox(['label' => 'Аватар при регистрации'])?>

    <?= $form->field($model, 'capcha')->checkBox(['label' => 'Капча при регистрации']);?>

	<?= Html::submitButton('Сохранить', ['class' => 'btn btn-primary'])?>

	<?php ActiveForm::end(); ?>
</div>
