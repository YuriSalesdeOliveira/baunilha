<?php

namespace Source\Library\PageBuilder;

class MinifierCSSFactory
{
    public static function create(): MinifierInterface
    {
        return new MatthiasMullieMinifyCSS();
    }
}