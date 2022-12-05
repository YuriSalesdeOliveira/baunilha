<?php

namespace Source\Library\PageBuilder;

use DOMElement;
use DOMNodeList;

class PageBuilder
{
    /** @var Page[] $components */
    protected array $components;

    protected string $scriptContent;
    protected string $styleContent;

    public function __construct(
        protected Page $baseHTML,
        protected string $styleOutputPath,
        protected string $scriptOutputPath,
    ) {
    }

    public function addComponent(Page $component): PageBuilder
    {
        $this->components[] = $component;

        return $this;
    }

    protected function addScript(DOMNodeList $scripts): void
    {
        $finalScriptContent = '';

        /** @var DOMElement $script */
        foreach ($scripts as $script) {
            $scriptContent = $this->scriptContent($script);

            $wrapperScriptContent = "(function(){{$scriptContent}})();";

            $finalScriptContent .= $wrapperScriptContent;
        }

        $this->scriptContent = $finalScriptContent;
    }

    protected function scriptContent(DOMElement $script): string
    {
        if ($src = $script->getAttribute('src')) {
            return file_get_contents($src);
        }

        return $script->nodeValue;
    }

    protected function addStyle(DOMNodeList $styles): void
    {
        $finalStyleContent = '';

        /** @var DOMElement $style */
        foreach ($styles as $style) {
            $styleContent = $this->styleContent($style);

            $finalStyleContent .= $styleContent;
        }

        $this->styleContent = $finalStyleContent;
    }

    protected function styleContent(DOMElement $style): string
    {
        if ($src = $style->getAttribute('src')) {
            return file_get_contents($src);
        }

        return $style->nodeValue;
    }

    protected function scriptGenerate(): bool
    {
        return !!file_put_contents($this->scriptOutputPath, $this->scriptContent);
    }

    protected function styleGenerate(): bool
    {
        return !!file_put_contents($this->styleOutputPath, $this->styleContent);
    }

    public function build(): string
    {
        foreach ($this->components as $component) {
            [$scripts, $styles, $section] = $component->getElementsByTagName(['script', 'style', 'section']);

            $this->addScript($scripts);
            $this->addStyle($styles);

            $this->baseHTML->appendChild($section->item(0), 'main');
        }

        $this->scriptGenerate();
        $this->styleGenerate();

        return $this->baseHTML->save();
    }
}
