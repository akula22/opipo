<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\post\models\Post */

$this->title = 'Изменение бумаги: ' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'бумага', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => substr($model->title, 0, 50), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="post-edit">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
