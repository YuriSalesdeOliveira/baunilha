<?php

namespace Source\Components\Contracts;

use Source\Library\PageBuilder\Page;

interface Component
{
    public static function handle(array $bodyParams, array $queryParams, array $args): Page;
}