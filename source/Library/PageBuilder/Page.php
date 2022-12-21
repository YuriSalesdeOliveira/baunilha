<?php

namespace Source\Library\PageBuilder;

use DOMNode;
use DOMDocument;
use App\Exceptions\PageException;

class Page
{
    protected DOMDocument $page;

    public function __construct(string $pagePath, array $args = [])
    {
        $page = new DOMDocument();
        @$page->loadHTML($this->render($pagePath, $args));

        $this->page = $page;
    }

    public function appendChild(DOMNode $elementChild, string $elementID): Page
    {
        [$element] = $this->getElementById([$elementID]);

        $elementChild = $this->page->importNode($elementChild, true);
        $element->appendChild($elementChild);

        return $this;
    }

    public function getElementById(array $IDList): array
    {
        $elementList = [];
        foreach ($IDList as $ID) {

            $element = $this->page->getElementById($ID);

            if (!$element) {

                throw new PageException("No element was found with the ID '{$ID}'");
            }

            $elementList[] = $element;
        }

        return $elementList;
    }

    public function getElementsByTagName(array $tagNameList): array
    {
        $elementList = [];
        foreach ($tagNameList as $tagName) {

            $elements = $this->page->getElementsByTagName($tagName);

            if (!$elements) {

                throw new PageException("No element was found with the tag name '{$tagNameList}'");
            }

            $elementList[] = $elements;
        }

        return $elementList;
    }

    public function save(): string|false
    {
        return $this->page->saveHTML();
    }

    protected function render(string $pagePath, array $args = []): string
    {
        if (!file_exists($pagePath)) {
            throw new PageException("No page found in the given path");
        }

        ob_start();

        foreach ($args as $variable => $value) {
            $$variable = $value;
        }

        require($pagePath);

        return ob_get_clean();
    }
}
