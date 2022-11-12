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

        $elementChild = $this->page->importNode($elementChild);
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

    public function getElementByTagName(array $tagNameList): array
    {
        $elementList = [];
        foreach ($tagNameList as $tagName) {

            $element = $this->page->getElementsByTagName($tagName)->item(0);

            if (!$element) {

                throw new PageException("No element was found with the tag name '{$tagNameList}'");
            }

            $elementList[] = $element;
        }

        return $elementList;
    }

    public function save(): string|false
    {
        return $this->page->saveHTML();
    }

    protected function render(string $pagePath, array $args = []): string
    {
        ob_start();

        foreach ($args as $variable => $value) {
            $$variable = $value;
        }

        require($pagePath);

        return ob_get_clean();
    }
}
