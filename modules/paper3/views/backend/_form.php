<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\ActiveForm;
?>


<?php $form = ActiveForm::begin(
    ['id' => 'paper-form'],
    ['enableClientValidation' => true],
    ['enableAjaxValidation' => true],
    ['validateOnChange' => true]
    ); 
    ?>

    <?= $form->field($model, 'title') ?>
    
    <?= $form->field($model, 'price') ?>


  

    <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', 
    ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>

    <?php 
    if(!$model->isNewRecord) 
    { 
      echo Html::a('Удалить', ['delete', 'id' => $model->id], [ 
            'class' => 'btn btn-danger', 
            'data' => [ 
                'confirm' => 'Вы уверены?', 
                'method' => 'post', 
            ], 
        ]);
    } 
    ?> 

<?php ActiveForm::end(); ?>


