<?php
return [
    'user' => [
        'type' => 1,
        'description' => 'User',
        'ruleName' => 'group',
        'children' => [
            'isOwner',
            'createComment',
        ],
    ],
    'moder' => [
        'type' => 1,
        'description' => 'moder',
        'ruleName' => 'group',
        'children' => [
            'user',
        ],
    ],
    'admin' => [
        'type' => 1,
        'description' => 'admin',
        'ruleName' => 'group',
        'children' => [
            'moder',
        ],
    ],
    'isOwner' => [
        'type' => 2,
        'description' => 'Update Owner',
        'ruleName' => 'isOwner',
    ],
    'createComment' => [
        'type' => 2,
        'description' => 'Создание комментария',
    ],
];
