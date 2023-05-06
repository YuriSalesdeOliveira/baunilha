<?php

use Database\Migrations\CreatePagesTable;
use Database\Seeders\Page;

return [
    'site' => [
        'name' => 'smoothie',
        'description' => 'Framework smoothie',
        'domain' => 'localhost',
        'locale' => 'pt_BR',
        'root' => 'http://localhost/smoothie',
        'basePath' => '/smoothie',
    ],
    'migrations' => [
        CreatePagesTable::class
    ],
    'seeders' => [
        Page::class
    ]
];
