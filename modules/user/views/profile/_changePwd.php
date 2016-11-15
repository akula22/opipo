<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="well">
   <?php $form = ActiveForm::begin(
    ['id' => 'change-pwd-form'],
    ['enableClientValidation' => true],
    ['enableAjaxValidation' => true],
    ['validateOnChange' => true]
    ); 
    ?>

    <?= $form->field($model, 'new_password')->passwordInput(['style'=>'width:530px']) ?>
    <?= $form->field($model, 'current_password')->passwordInput(['style'=>'width:530px']) ?>

    <?= Html::submitButton(Yii::t('main', 'Save'), ['class' => 'button'])?>

<?php ActiveForm::end(); ?>



</div>


