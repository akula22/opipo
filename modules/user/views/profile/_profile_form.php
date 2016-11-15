<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\fileapi\Widget;
use app\modules\user\models\Profile;
?>
<div class="well">
   <?php $form = ActiveForm::begin(
    ['id' => 'user-form'],
    ['enableClientValidation' => true],
    ['enableAjaxValidation' => true],
    ['validateOnChange' => true]
    ); 
    ?>

    <?= $form->field($model, 'firstname') ?>
    <?= $form->field($model, 'lastname') ?>
    <?= $form->field($model, 'gender')->dropDownList(Profile::getGenderArray()) ?>

    <?= $form->field($model, 'avatar')->widget(
            Widget::className(),
            [
                'settings' => [
                    'url' => ['fileapi-upload']
                ],
                'crop' => true,
                'cropResizeWidth' => 100,
                'cropResizeHeight' => 100
            ]
        ) 
    ?>
    

    <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus fa-fw"></i> ' . Yii::t('main', 'Add') : '<i class="fa fa-floppy-o fa-fw"></i> ' . Yii::t('main', 'Save'), 
    ['class' => $model->isNewRecord ? 'button' : 'button'])?>

<?php ActiveForm::end(); ?>



</div>


