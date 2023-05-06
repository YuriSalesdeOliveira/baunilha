<?php

namespace Source\Components;

use Source\Library\PageBuilder\Page;

class Slide implements ComponentInterface
{
    public static function handle(array $bodyParams, array $queryParams, array $args): Page
    {
        $componentView = new Page(
            paths('resources.components') . '/slide/index.php',
            $args
        );

        return $componentView;
    }
}
