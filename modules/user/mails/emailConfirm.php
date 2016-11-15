<?php
use yii\helpers\Html;
 
/* @var $this yii\web\View */
/* @var $user app\modules\user\models\User */
 
$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/signup/email-confirm', 'token' => $user->email_confirm_token]);
?>
 
Здравствуйте, <?= Html::encode($user->username) ?>! <br />
 
Для подтверждения адреса пройдите по ссылке:<br />
 
<?= Html::a(Html::encode($confirmLink), $confirmLink) ?><br />
 
Если Вы не регистрировались у на нашем сайте, то просто удалите это письмо.