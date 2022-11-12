<?php

namespace Source\Library\PageBuilder;

use DOMNode;

class PageBuilder
{
    /** @var Page[] $components */
    protected array $components;

    protected string $scriptContent;
    protected string $styleContent;

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

    protected function addScript(DOMNode $script): void
    {
        $finalScript = "(function(){{$script->nodeValue}}());";

        if (empty($this->scriptContent)) {

            $this->scriptContent = $finalScript;

            return;
        }

        $this->scriptContent .= $finalScript;
    }

    protected function addStyle(DOMNode $style): void
    {
        if (empty($this->styleContent)) {

            $this->styleContent = $style->nodeValue;

            return;
        }
        $this->styleContent .= $style->nodeValue;
    }

    protected function scriptGenerate(): bool
    {
        return !!file_put_contents($this->scriptOutputPath, $this->scriptContent);
    }

    protected function styleGenerate(): bool
    {
        return !!file_put_contents($this->styleOutputPath, $this->styleContent);
    }

    public function build(): string|false
    {
        foreach ($this->components as $component) {

            [$script, $style, $section] = $component->getElementByTagName(['script', 'style', 'section']);

            $this->addScript($script);
            $this->addStyle($style);

            $this->baseHTML->appendChild($section, 'main');
        }

        $this->scriptGenerate();
        $this->styleGenerate();

        return $this->baseHTML->save();
    }
}
