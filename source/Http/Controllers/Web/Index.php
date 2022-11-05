<?php

namespace Source\Http\Controllers\Web;

use Source\Http\Controllers\Controller;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Index extends Controller
{
    public function handle(Request $request, Response $response): Response
    {
        return $response;
    }
}
