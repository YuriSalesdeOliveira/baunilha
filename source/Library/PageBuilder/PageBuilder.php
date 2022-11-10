<?php

namespace Source\Library\PageBuilder;

class PageBuilder
{
    /** @var Page[] $components */
    protected array $components;

    public function __construct(
        protected Page $baseHTML,
        protected string $styleOutputPath,
        protected string $scriptOutputPath
    ) {
    }

    public function addComponent(string $name, Page $component): PageBuilder
    {
        $this->components[$name] = $component;

        return $this;
    }

    public function removeComponent(string $name): bool
    {
        if (isset($this->components[$name])) {

            unset($this->components[$name]);

            return true;
        }

        return false;
    }
    
    protected function scriptGenerate(): bool
    {
        return false;
    }

    protected function styleGenerate(): bool
    {
        return false;
    }

    public function build()
    {
        foreach ($this->components as $component) {

            [$script, $style, $section] = $component->getElementByTagName(['script', 'style', 'section']);

            $this->scriptGenerate($script);
            $this->styleGenerate($style);

            $this->baseHTML->appendChild($section, 'body');
        }

        return $this->baseHTML->save();
    }
}
