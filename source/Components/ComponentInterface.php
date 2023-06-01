<?php

namespace Source\Components;

interface ComponentInterface
{
    public static function handle(array $bodyParams, array $queryParams, array $args): ComponentView;
}