<?php
use yii\helpers\Html;
?>

<ul>
    <?php foreach($locales as $key => $var) : ?>
        <li><?= Html::a(Html::img('/images/' . $var . '.png', ['style' => 'height:16px']) . ' ' . $var, ['/setlocale', 'locale' => $var]) ?></li>
    <?php endforeach; ?>
</ul>