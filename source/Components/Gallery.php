<?php

namespace Source\Components;

use Source\Library\PageBuilder\Page;
use Source\Components\Contracts\Component as ComponentContract;

class Gallery implements ComponentContract
{
    public static function handle(array $bodyParams, array $queryParams, array $args): Page
    {
        $componentView = new Page(
            paths('resources.components') . "/gallery/index.php",
            $args
        );

        return $componentView;
    }
}
