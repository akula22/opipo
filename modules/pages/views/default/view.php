<?php
use yii\helpers\Html;

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;

$this->registerMetaTag(['name' => 'description', 'content' => $model->description]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $model->keywords]);
?>

<div class="well">
<h1><?= $model->title ?></h1>

<div>
    <?= $model->full ?>
</div>
</div>
