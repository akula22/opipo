<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/js/calc3.js');

$this->title = 'Широкоформатная печать';
$this->params['breadcrumbs'][] = $this->title;
$array = [];
// $array = json_encode(['name' => 'A0', 'w' => '84.1', 'h' => '118.9']);
$array[] = 'Другой формат';
$array['A0'] = 'A0';
$array['A1'] = 'A1';
$array['A2'] = 'A2';
$array['A3'] = 'A3';
$array['A4'] = 'A4';
$array['A5'] = 'A5';
$array['A6'] = 'A6';
?>
  
  <!-- <div class="alert alert-danger" role="alert">Калькулятор в стадии разработки</div>    -->

<div class="well">
    
    <?php $form = ActiveForm::begin(
    ['id' => 'calc-form'],
    ['enableClientValidation' => true],
    ['enableAjaxValidation' => true],
    ['validateOnChange' => true]
    ); 
    ?>


<div class="row">
    <div class="col-sm-6">
        <?= $form->field($model, 'paper')->dropDownList(\yii\helpers\ArrayHelper::map(
            app\modules\paper3\models\Paper::find()->all(), 
            'id',
            'title'
        ),  ['onchange' => 'getData()']) ?>

        <?= $form->field($model, 'format')->dropDownList($array,  ['onchange' => 'getData()']) ?>

        
                <?= $form->field($model, 'unit')->dropDownList(
                    [
                        1000000 => 'мм', 
                        10000 => 'см', 
                        0 => 'метр'
                    ], 
                    ['options' =>
                        [
                            10000 => ['selected ' => true]
                        ], 'onchange' => 'getUnit()'
                    ]) ?>
        
        <input type="hidden" id="unit_tmp" />
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'width')->textInput( ['onkeypress' => 'getData()', 'value' => ''] ) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'height')->textInput( ['onkeypress' => 'getData()', 'value' => ''] ) ?>
            </div>
        </div>

        <?= $form->field($model, 'numberPaper')->textInput( ['onkeypress' => 'getData()', 'value' => '1'] ) ?>

        <div class="well" align="center">
            <p> 
                <h2 id="price-total" class="alert alert-info"></h2>
            </p>
        </div>
        <input type="hidden" id="A0" data-width="84.1" data-height="118.9" />
        <input type="hidden" id="A1" data-width="59.4" data-height="84.1" />
        <input type="hidden" id="A2" data-width="42" data-height="59.4" />
        <input type="hidden" id="A3" data-width="29.7" data-height="42" />
        <input type="hidden" id="A4" data-width="21" data-height="29.7" />
        <input type="hidden" id="A5" data-width="14.8" data-height="21" />
        <input type="hidden" id="A6" data-width="10.5" data-height="14.8" />
    </div>

</div>     
    <?php ActiveForm::end(); ?>
</div>    