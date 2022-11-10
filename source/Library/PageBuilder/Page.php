<?php

namespace Source\Library\PageBuilder;

use DOMDocument;
use DOMNode;

class Page
{
    protected DOMDocument $page;

    public function __construct(string $pagePath)
    {
        $page = new DOMDocument();
        @$page->loadHTML($this->fileContent($pagePath));

        $this->page = $page;
    }

    public function appendChild(DOMNode $element, string $inTagName): Page
    {
        [$inTag] = $this->getElementByTagName([$inTagName]);

        $element = $this->page->importNode($element);
        $inTag->appendChild($element);

        return $this;
    }

    public function getElementByTagName(array $tagNameList): array
    {
        $elementList = [];
        foreach ($tagNameList as $tagName) {

            $elementList[] = $this->page->getElementsByTagName($tagName)->item(0);
        }

        return $elementList;
    }

    public function save(): string|false
    {
        return $this->page->saveHTML();
    }

    protected function fileContent(string $pagePath): string
    {
        ob_start();

        require($pagePath);

        return ob_get_clean();
    }
}
