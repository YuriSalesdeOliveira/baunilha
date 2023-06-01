<?php

use Slim\App;
use Source\Http\Controllers\Web\Index;

return function (App $app) {

    /**
     * Rota para as paginas
     */
    $app->get('[/{path:.*}]', [Index::class, 'handle'])->setName('index.handle');
};
