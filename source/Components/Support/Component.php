<?php

namespace Source\Components\Support;

use App\Exceptions\ComponentException;
use Source\Components\Contracts\Component as ComponentContract;

class Component
{
    public static function get(string $componentName, $namespace = 'Source\Components'): ComponentContract
    {
        $componentClass = "{$namespace}\\" . ucfirst($componentName);
        if (class_exists($componentClass)) {

            return new $componentClass();
        }

        throw new ComponentException('The component was not found');
    }
}
