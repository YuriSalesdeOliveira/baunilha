<?php

function paths(string $key): string
{
    $paths = require(__DIR__ . '/paths.php');

    return $paths[$key] ?? false;
}

function app(string $key, string|array $default): string|array
{
    $app = require(__DIR__ . '/app.php');

    $keyAsArray = explode('.', $key);

    foreach ($keyAsArray as $key) {

        if (is_array($app)) {

            $app = $app[$key];

            continue;
        }

        throw new Exception("Undefined array key \"$key\"");
    }

    return $app ?? $default;
}
