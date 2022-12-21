<?php

namespace Source\Http\Controllers\Components;

use Source\Library\PageBuilder\Page;
use Source\Http\Controllers\Components\Contracts\Component;

class Gallery implements Component
{
    public function handle(array|null $bodyParams, array|null $queryParams, array $args): Page
    {
        $component = new Page(
            paths('resources') . "/components/gallery/index.php",
            args: [
                'route' => $args['route']
            ]
        );

        return $component;
    }
}
