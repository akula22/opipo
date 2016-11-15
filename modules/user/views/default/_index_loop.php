<?php
/**
 * Цикл всех пользователей.
 * @var yii\base\View $this
 * @var app\modules\user\models\User $dataProvider
 */

use yii\widgets\ListView;

echo ListView::widget([
	'dataProvider' => $dataProvider,
	'layout' => '<div class="row">{items}</div><div class="row">{pager}</div>',
	'itemView' => '_index_item',
	'itemOptions' => [
	    'class' => 'user col-sm-12',
	    // 'style' => 'padding:10px',
	    'tag' => 'div',
	    // 'itemscope' => true,
	    // 'itemtype' => 'http://schema.org/Person'
	]
]);