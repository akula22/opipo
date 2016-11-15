<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/reset', 'token' => $user->password_reset_token]);
?>

Приветствуем вас <?= Html::encode($user->username) ?><br />

Вы запросили сброс пароля, если вы этого не делали то просто удалите это письмо<br />

Если вы это сделали, перейдите по ссылке ниже для установки нового пароля:<br />

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
