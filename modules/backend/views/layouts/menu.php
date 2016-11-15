<?php
use app\modules\backend\models\Menu;
use app\modules\backend\models\Info;

echo Menu::widget([
                    'options' => ['class' => 'sidebar-menu'],
                    'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
                    'submenuTemplate' => "\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
                    'activateParents' => true,
                    'items' => [
                        [
                            'label' => 'Главное',
                            'options' => ['class' => 'header']
                        ],
                        [
                            'label' => 'Пользователи',
                            'icon' => '<i class="fa fa-users"></i>',
                            'url' => ['/backend/user/index'],
                            'visible' => Yii::$app->user->can('moder')
                        ],
                        [
                            'label' => 'Калькулятор офсет',
                            'icon'=>'<i class="fa fa-calculator"></i>',
                            'url'=>['/backend/paper/index']
                        ],
                        [
                            'label' => 'Фото печать',
                            'icon'=>'<i class="fa fa-calculator"></i>',
                            'url'=>['/backend/paper2/index']
                        ],
                        [
                            'label' => 'Широкоформат',
                            'icon'=>'<i class="fa fa-calculator"></i>',
                            'url'=>['/backend/paper3/index']
                        ],
                        [
                            'label' => 'Страницы',
                            'icon'=>'<i class="fa fa-file"></i>',
                            'url'=>['/backend/pages/index']
                        ],
                    ]
                ]) ?>
