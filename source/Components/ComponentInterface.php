<?php

namespace Source\Components;

use Source\Library\PageBuilder\Page;

interface ComponentInterface
{
    public static function handle(array $bodyParams, array $queryParams, array $args): ComponentView;
}