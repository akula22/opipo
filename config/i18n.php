<?php
return [
            'translations' => [
                'main*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'main'       => 'main.php',
                    ],
                ],

                'career*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap' => [
                        'career'       => 'career.php',
                    ],
                ],
            ],
        ];