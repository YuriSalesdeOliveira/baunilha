<?php

namespace Source\Library\PageBuilder;

interface MinifierInterface
{
    public function add(string $data): static;
    public function minify(): string;
}