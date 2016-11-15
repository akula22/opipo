<?php
/**
 * Шаблон одного пользователя на странице всех записей.
 */

use yii\helpers\Html;
?>

<div class="well">
<div class="row">
	<div class="col-lg-4">
		<strong>
			<?= Html::a($model->username, ['view', 'username' => $model['username']]) ?>
		</strong>

		<div class="user-avatar">
    		<?php $avatar = $model->profile->avatar ? $model->profile->urlAttribute('avatar') : Yii::$app->assetManager->publish('@app/public_html/upload/images/avatar/noavatar.png')[1]; ?>

  			<?= Html::a(Html::img($avatar), ['view', 'username' => $model->username]) ?>
		</div>
	</div>
	<div class="col-lg-8">
		<?= Html::encode($model->profile->firstname); ?> <?= Html::encode($model->profile->lastname); ?><br />
		Пол: <?= Html::encode($model->profile->genderName); ?>
	</div>
</div>
</div>