<?php

namespace Source\Http\Controllers\Web;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteContext;
use Source\Components\Component;
use Source\Http\Controllers\Controller;
use Source\Library\PageBuilder\Page;
use Source\Library\PageBuilder\PageBuilder;

class Index extends Controller
{
    public function handle(Request $request, Response $response): Response
    {
        $routeContext = RouteContext::fromRequest($request);
        $routeParser = $routeContext->getRouteParser();

        $baseHTML = new Page(
            paths('resources') . '/template/baseHTML.php',
            args: [
                'title' => app('site.name', 'smoothie'),
                'route' => $routeParser
            ]
        );

        $pageBuilder = new PageBuilder(
            $baseHTML,
            styleOutputPath: paths('public') . '/assets/css/style.css',
            scriptOutputPath: paths('public') . '/assets/js/script.js'
        );

        $componentsList = ['slide', 'gallery', 'slide', 'slide'];

        foreach ($componentsList as $componentName) {
            $componentClass = Component::create($componentName);

            $componentView = $componentClass->handle(
                $request->getParsedBody() ?? [],
                $request->getQueryParams() ?? [],
                args: [
                    'route' => $routeParser
                ]
            );

            $pageBuilder->addComponentView($componentView);
        }

        $page = $pageBuilder->build();

        $response->getBody()->write($page);
        return $response;
    }
}
