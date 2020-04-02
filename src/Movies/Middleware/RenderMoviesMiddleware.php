<?php

namespace Movies\Middleware;

use Laminas\Diactoros\Response\HtmlResponse;
use Movies\BasicRenderer;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Class RenderMoviesMiddleware
 * @package Movies\Middleware
 */
class RenderMoviesMiddleware implements RequestHandlerInterface
{
    /**
     * @var array|\Traversable
     */
    private $movieData;

    /**
     * RenderMoviesMiddleware constructor.
     * @param array|\Traversable $movieData
     */
    public function __construct($movieData)
    {
        $this->movieData = $movieData;
    }

    /**
     * @param ServerRequestInterface $request
     * @return ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $renderer = (new BasicRenderer())(
            $this->movieData
        );
        return new HtmlResponse($renderer);
    }
}
