<?php

namespace Source\Http\Controllers\Web;

use Slim\Routing\RouteContext;
use Source\Library\PageBuilder\Page;
use Source\Http\Controllers\Controller;
use Source\Components\Support\Component;
use Source\Library\PageBuilder\PageBuilder;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Index extends Controller
{
    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $baseHTML = new Page(
            paths('resources') . '/template/baseHTML.php',
            args: [
                'title' => 'smoothie',
                'route' => $routeParser
            ]
        );

        $pageBuilder = new PageBuilder(
            $baseHTML,
            styleOutputPath: paths('public') . '/assets/css/style.css',
            scriptOutputPath: paths('public') . '/assets/js/script.js'
        );

        $componentList = ['slide', 'gallery'];
        foreach ($componentList as $componentName) {

            $componentClass = Component::get($componentName);

            $componentView = $componentClass->handle(
                $request->getParsedBody() ?? [],
                $request->getQueryParams() ?? [],
                args: [
                    'route' => $routeParser
                ]
            );

            $pageBuilder->addComponent($componentView);
        }

        $page = $pageBuilder->build();

        $response->getBody()->write($page);
        return $response;
    }
}
