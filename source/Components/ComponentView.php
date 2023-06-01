<?php

namespace Source\Components;

use Source\Library\PageBuilder\Page;

readonly class ComponentView
{
    public function __construct(
        protected string $id,
        protected Page   $page,
    )
    {
    }

    public static function create(string $id, Page $page): static
    {
        return new static($id, $page);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getPage(): Page
    {
        return $this->page;
    }
}