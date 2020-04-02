<?php

namespace Movies\Middleware;

use Interop\Container\ContainerInterface;

class RenderMoviesMiddlewareFactory
{
    /**
     * @param ContainerInterface $container
     * @return RenderMoviesMiddleware
     */
    public function __invoke(ContainerInterface $container) : RenderMoviesMiddleware
    {
        $movieData = $container->has('MovieData')
            ? $container->get('MovieData')
            : null;

        return new RenderMoviesMiddleware($movieData);
    }
}
