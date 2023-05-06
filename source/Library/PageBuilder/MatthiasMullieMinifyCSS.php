<?php

namespace Source\Library\PageBuilder;

use MatthiasMullie\Minify\CSS;

class MatthiasMullieMinifyCSS implements MinifierInterface
{
    protected string $data = '';

    public function add(string $data): static
    {
        $this->data .= $data;

        return $this;
    }

    public function minify(): string
    {
        $minifyCSS = new CSS();
        $minifyCSS->add($this->data);

        return $minifyCSS->minify();
    }
}