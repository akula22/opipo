<?php
    use yii\helpers\Html;
    $avatar = $model->profile->avatar ? $model->profile->urlAttribute('avatar') : Yii::$app->assetManager->publish('@app/public_html/upload/images/avatar/noavatar.png')[1]; 
?>

<div class="header">
    <h1 class="page-title"><?= Html::encode($this->title); ?> <?= $model->username?></h1>
</div>


<div class="well">   
    <div class="row">     
        <div class="col-xs-3">
            <?= Html::a(Html::img($avatar), ['view', 'username' => $model->username]) ?>
        </div>
    
     	<div class="col-xs-4">
      		<?= $model->profile->firstname?>
      		<?= $model->profile->lastname?>
      	 </div>
        <div class="col-xs-5">
               
        </div>
    </div>
</div>





