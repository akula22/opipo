<?php
use yii\helpers\Html;

$this->title = Yii::t('main', 'Users');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-title"><?= Html::encode($this->title); ?></div>


	<?= $this->render('_index_loop', [
		'dataProvider' => $dataProvider
	]); ?>
