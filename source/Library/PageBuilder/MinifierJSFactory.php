<?php

namespace Source\Library\PageBuilder;

class MinifierJSFactory
{
    public static function create(): MinifierInterface
    {
        return new MatthiasMullieMinifyJS();
    }
}