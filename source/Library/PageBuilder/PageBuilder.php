<?php

namespace Source\Library\PageBuilder;

use DOMElement;
use DOMNodeList;
use Source\Components\ComponentView;

class PageBuilder
{
    /** @var ComponentView[] $components */
    protected array $componentViewsList;
    protected string $scriptContent = '';
    protected string $styleContent = '';

    public function __construct(
        protected Page   $baseHTML,
        protected string $styleOutputPath,
        protected string $scriptOutputPath,
    )
    {
    }

    public function addComponentView(ComponentView $componentView): PageBuilder
    {
        $this->componentViewsList[] = $componentView;

        return $this;
    }

    protected function addScript(DOMNodeList $scripts): void
    {
        /** @var DOMElement $script */
        foreach ($scripts as $script) {
            $scriptContent = $this->scriptContent($script);

            $wrapperScriptContent = "(function(){{$scriptContent}})();";

            $this->scriptContent .= $wrapperScriptContent;
        }
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
        /** @var DOMElement $style */
        foreach ($styles as $style) {
            $styleContent = $this->styleContent($style);

            $this->styleContent .= $styleContent;
        }
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
        $minifierJS = MinifierJSFactory::create();
        $minifierJS->add($this->scriptContent);

        return is_numeric(file_put_contents($this->scriptOutputPath, $minifierJS->minify()));
    }

    protected function styleGenerate(): bool
    {
        $minifierCSS = MinifierCSSFactory::create();
        $minifierCSS->add($this->styleContent);

        return is_numeric(file_put_contents($this->styleOutputPath, $minifierCSS->minify()));
    }

    public function build(): string
    {
        $addedComponentViewIds = [];
        foreach ($this->componentViewsList as $componentView) {
            [$scripts, $styles, $section] = $componentView->getPage()->getElementsByTagName(['script', 'style', 'section']);

            if (!in_array($componentView->getId(), $addedComponentViewIds)) {
                $this->addScript($scripts);
                $this->addStyle($styles);
            }

            $this->baseHTML->appendChild($section->item(0), 'app');

            $addedComponentViewIds[] = $componentView->getId();
        }

        $this->scriptGenerate();
        $this->styleGenerate();

        return $this->baseHTML->save();
    }
}
