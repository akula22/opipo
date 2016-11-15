<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;

$this->title = Yii::t('main', 'Profile');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-title"><?= Html::encode($this->title)?></div>

<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => Yii::t('main', 'Profile'),
            'content' => $this->render('/profile/_profile_form', ['model' => $model]),
            'active' => $active['profile'],
        ],
        [
            'label' => Yii::t('main', 'Change password'),
            'content' => $this->render('/profile/_changePwd', ['model' => $user]),
            'active' => $active['pwd'],
        ],
    ],
]);?>
