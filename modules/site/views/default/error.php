<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="page-title"><?= Html::encode($this->title) ?></div>

    <div class="well alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>



