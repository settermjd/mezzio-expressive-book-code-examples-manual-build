<?php

namespace Movies;

use Movies\Middleware\RenderMoviesMiddleware;
use Movies\Middleware\RenderMoviesMiddlewareFactory;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
        ];
    }

    public function getDependencyConfig() : array
    {
        return [
            'factories' => [
                RenderMoviesMiddleware::class => RenderMoviesMiddlewareFactory::class
            ],
        ];
    }
}
