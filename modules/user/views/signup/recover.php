<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

$this->title = Yii::t('main', 'Recovery password'); 
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-title"><?= Html::encode($this->title)?></div>

     <div class="well">
        <p><?= \Yii::t('main', 'Enter Email')?></p>

            <?php $form = ActiveForm::begin(['id' => 'recover']); ?>
                <?= $form->field($model, 'email')->textInput(['style'=>'width:537px']) ?>

                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-paper-plane"></i> &nbsp;' . \Yii::t('main', 'Send'), ['class' => 'button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        
    </div>

