<?php

return [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                // '' => 'site/default/index',
                '' => 'site/default/largeformat',
               
                '<_a:(login|logout)>' => 'user/signup/<_a>',
               

                // 'photo' => 'album/default/index',

                // # Статические страницы
                // 'page/<alias:\w+>' => 'pages/default/view',

                'photoprint' => 'site/default/photoprint',

                'largeformat' => 'site/default/largeformat',
                

                # backend
                'backend/default/index' => 'backend/default/index',
                'backend/<_m:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/backend/<_a>',
                'backend/settings' => 'backend/default/settings',
                'backend' => 'backend/default/index',
                # Статические страницы
                [
                    'class' => 'app\components\StaticPagesUrlRule', 
                ],
                '<_m:[\w\-]+>/<_c:[\w\-]+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
            ]
        ];
