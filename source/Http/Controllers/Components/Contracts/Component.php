<?php

namespace Source\Http\Controllers\Components\Contracts;

use Source\Library\PageBuilder\Page;

interface Component
{
    public function handle(array|null $bodyParams, array|null $queryParams, array $args): Page;
}
