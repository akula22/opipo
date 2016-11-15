<?php
use yii\helpers\Html;
use yii\widgets\Menu;
?>

<?php if(\Yii::$app->user->isGuest): ?>

<?= Menu::widget([
	'encodeLabels' => false,
    'items' => [
    	['label' => Yii::t('main', 'Signup'), 'url' => ['/user/signup/signup']],

    	['label' => '&raquo;',  'url' => ['/user/signup/recover']],

    	['label' => Yii::t('main', 'Login'), 'url' => ['/user/signup/login']],

    
    ],
]);
?>

<?php else: ?>

<?= Menu::widget([
    'items' => [
    	['label' => Yii::t('main', 'Exit') . ' (' . Yii::$app->user->identity->username . ')', 'url' => Yii::$app->getUrlManager()->createUrl('user/signup/logout'), 'visible' => !Yii::$app->user->isGuest],

    	['label' => Yii::t('main', 'Messages') . '(' . $newMessage . ')', 'url' => ['/pm/default/index'], !$newMessage ? '' : 'options' => ['class' => 'active'] ],

    	['label' => Yii::t('main', 'Profile'), 'url' => ['/user/default/profile']],

    	['label' => 'Admin Panel', 'url' => Yii::$app->getUrlManager()->createUrl('/backend/default/index'), 'visible' => Yii::$app->user->can('moder'), 'class' => 'red'], 
    ],
]);
?>
<?php endif;?>
