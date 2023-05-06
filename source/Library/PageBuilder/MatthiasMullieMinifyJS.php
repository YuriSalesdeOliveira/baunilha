<?php

namespace Source\Library\PageBuilder;

use MatthiasMullie\Minify\JS;

class MatthiasMullieMinifyJS implements MinifierInterface
{
    protected string $data = '';

    public function add(string $data): static
    {
        $this->data .= $data;

        return $this;
    }

    public function minify(): string
    {
        $minifyJS = new JS();
        $minifyJS->add($this->data);

        return $minifyJS->minify();
    }
}