<?php

namespace Source\Components;

use App\Exceptions\ComponentException;

class Component
{
    public static function create(string $componentName): ComponentInterface
    {
        $componentsList = app('components', []);

        if (in_array($componentName, array_keys($componentsList))) {

            $componentClass = $componentsList[$componentName];

            if (class_exists($componentClass)) {

                return new $componentClass();
            }

            throw new ComponentException("The class component $componentName was not found");
        }

        throw new ComponentException("The component $componentName not found in components list");
    }
}
