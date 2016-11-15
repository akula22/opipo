<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = Yii::t('main', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="page-title"><?= Html::encode($this->title)?></div>

             <?php $form = ActiveForm::begin(['id' => 'form-login', 'options' => ['class' => 'form-group']]); ?>
             <div class="well">
                <?= $form->field($model, 'email')->textInput() ?>
          
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                
                <!-- <div class="form-group">
                    <?= Html::a(Yii::t('main', 'Forgot your password?'), ['/user/signup/recover']) ?>
                </div> -->
                
                <div class="form-group">
                    <?= Html::submitButton('<i class="fa fa-check-square-o"></i>  &nbsp;'.Yii::t('main', 'Login'), ['class' => 'btn', 'name' => 'login-button']) ?>
                </div>


               
            <?php ActiveForm::end(); ?>
        </div>


