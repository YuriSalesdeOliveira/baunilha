<?php

namespace Source\Components;

use Source\Library\PageBuilder\Page;

class Gallery implements ComponentInterface
{
    public static function handle(array $bodyParams, array $queryParams, array $args): ComponentView
    {
        $page = new Page(
            paths('resources.components') . '/gallery/index.php',
            $args
        );

        return ComponentView::create(
            'gallery',
            $page
        );
    }
}
