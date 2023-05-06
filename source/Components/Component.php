<?php

namespace Source\Components;

use App\Exceptions\ComponentException;

class Component
{
    public static function parse(string $componentName, string $namespace = 'Source\Components'): ComponentInterface
    {
        $componentClass = "$namespace\\$componentName";
        if (class_exists($componentClass)) {

            return new $componentClass();
        }

        throw new ComponentException('The component was not found');
    }
}
