<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('/images/logo.png', ['style' => 'width:140px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Офсет', 'url' => ['/site/default/index']],
            ['label' => 'Фото печать', 'url' => ['/site/default/photoprint']],
            ['label' => 'Широкоформат', 'url' => ['/site/default/largeformat']],
            ['label' => 'Контакты', 'url' => ['/pages/default/view', 'alias' => 'feedback']],
            ['label' => 'Admin Panel', 'url' => Yii::$app->getUrlManager()->createUrl('/backend/default/index'), 'visible' => Yii::$app->user->can('moder'), 'class' => 'red'
                ], 
            Yii::$app->user->isGuest ?
                ['label' => 'Вход', 'url' => ['/user/signup/login']] :
                [
                    'label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/signup/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ]
                
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Yii::$app->name ?> <?= date('Y') ?></p>

        <p class="pull-right">Powered by (: <!-- vk.com/psych88 --></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
