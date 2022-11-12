<?php

use Slim\App;
use Source\Http\Controllers\Web\Index;

return function (App $app) {
    
    $app->get('/', [Index::class, 'handle'])->setName('index.handle');
    
};
