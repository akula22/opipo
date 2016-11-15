<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->registerJsFile('/js/calc.js');

$settings = Yii::$app->cache->get('settings');
$this->title = $settings['title'];
$this->registerMetaTag(['name' => 'keywords', 'content' => $settings['keywords']]);
$this->registerMetaTag(['name' => 'description', 'content' => $settings['description']]);

$this->title = 'Калькулятор офсет';
$this->params['breadcrumbs'][] = $this->title;
$digitalArray = [0, 1, 2, 3, 4];
?>
    
<div class="alert alert-danger" role="alert">Калькулятор в стадии разработки</div>   

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
            app\modules\paper\models\Paper::find()->all(), 
            'id',
            'title'
        ),  ['onchange' => 'getData()']) ?>

        <?= $form->field($model, 'numberPaper')->textInput( ['onkeypress' => 'getData()', 'value' => ''] ) ?>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'width')->textInput( ['onkeypress' => 'getData()', 'value' => ''] ) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'height')->textInput( ['onkeypress' => 'getData()', 'value' => ''] ) ?>
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'chromaticity')->dropDownList($digitalArray, ['onchange' => 'getData()']) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'chromaticity2')->dropDownList($digitalArray, ['onchange' => 'getData()'])->label('&nbsp;'); ?>
            </div>
        </div>       
    </div>


    <div class="col-sm-6">
        <?= $form->field($model, 'himself')->checkbox(['label'=>' Сам на себя', 'onchange' => 'getData()'])->label(''); ?>
    </div>
       
            <input type="hidden" id="priceRun" value="<?= $settings['priceRun']?>">
            <input type="hidden" id="indent" value="<?= $settings['indent']?>">
        
            <input type="hidden" id="pricePrintingPlate" value="<?= $settings['pricePrintingPlate']?>">
       
        <div class="col-sm-6">
            <div class="well" align="center">
                <p> 
                    <h2 id="price-total" class="alert alert-info"></h2>
                </p>
            </div>
        </div>
    
</div>     
    <?php ActiveForm::end(); ?>
</div>    

