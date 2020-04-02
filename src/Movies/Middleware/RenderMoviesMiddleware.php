<?php

namespace Movies\Middleware;

use Laminas\Diactoros\Response\HtmlResponse;
use Movies\BasicRenderer;
use Psr\Http\Message\ServerRequestInterface;

class RenderMoviesMiddleware
{
    private $movieData;

    public function __construct($movieData)
    {
        $this->movieData = $movieData;
    }

    public function __invoke(ServerRequestInterface $request) {
        $renderer = (new BasicRenderer())(
            $this->movieData
        );
        return new HtmlResponse($renderer);
    }
}
