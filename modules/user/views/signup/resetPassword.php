<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-title"><?= Html::encode($this->title) ?></div>

    

    <div class="well">
        <p>Укажите новый пароль:</p>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="form-group">
                    <?= Html::submitButton('Сохранить', ['class' => 'button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        
    </div>

