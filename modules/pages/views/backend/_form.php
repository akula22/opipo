<?php
	use yii\helpers\Html;
	use yii\widgets\ActiveForm;
    use yii\web\JsExpression;
	// $this->registerJs('alert("test!");');
	$this->registerJsFile('/js/editor/ckeditor.js');
    // $this->registerJsFile('/js/admin/jquery.li-translit.js');
    $this->registerJs("
        CKEDITOR.replace( 'pages-full',
        {
           toolbar : 'Admin',
           skin    : 'office2003',
           height  : '400px',
           filebrowserBrowseUrl : '/js/editor/ckfinder/ckfinder.html',
           filebrowserImageBrowseUrl : '/js/editor/ckfinder/ckfinder.html?Type=Images',
           filebrowserImageUploadUrl : '/js/editor/ckfinder/core/connector/php/connector.           php?command=QuickUpload&type=Images',
           on: {
              instanceReady:function( ev ){
                 jQuery(CKEDITOR.instances['pages-full'].container.$).mouseleave(function() {
                    CKEDITOR.instances['pages-full'].updateElement();
                 });
                 CKEDITOR.instances['pages-full'].on('blur', function() {
                    CKEDITOR.instances['pages-full'].updateElement();
                 });
              }
           }
        });
    "); 
?>


<?php $form = ActiveForm::begin(
	['id' => 'pages-form'],
	['enableClientValidation' => true],
	['enableAjaxValidation' => true],
	['validateOnChange' => true]
	); 
	?>

 	<?= $form->field($model, 'title') ?>
    <?php //if(!$model->isNewRecord):?>
 	  <?= $form->field($model, 'alias') ?>
    <?php //endif; ?>
 	<?= $form->field($model, 'full')->textArea(); ?>

  

 	<div class="alert alert-success" role="alert">
 		<b>SEO</b>
 	</div>
 	<?= $form->field($model, 'keywords') ?>
 	<?= $form->field($model, 'description')->textArea(['rows' => 4]); ?>

 	<?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', 
 	['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>

<?php ActiveForm::end(); ?>


