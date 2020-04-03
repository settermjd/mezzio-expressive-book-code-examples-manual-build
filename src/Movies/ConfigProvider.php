<?php

namespace Movies;

use Mezzio\Application;
use Mezzio\Container\ApplicationConfigInjectionDelegator;
use Movies\Middleware\RenderMoviesMiddleware;
use Movies\Middleware\RenderMoviesMiddlewareFactory;

class ConfigProvider
{
    public function __invoke() : array
    {
        return [
            'dependencies' => $this->getDependencyConfig(),
            'routes' => $this->getRouteConfig(),
        ];
    }

    public function getRouteConfig() : array
    {
        return [
            [
                'path'            => '/',
                'middleware'      => RenderMoviesMiddleware::class,
                'allowed_methods' => ['GET'],
            ],
        ];
    }

    public function getDependencyConfig() : array
    {
        return [
            'factories' => [
                RenderMoviesMiddleware::class => RenderMoviesMiddlewareFactory::class
            ],
            'delegators' => [
                Application::class => [
                    ApplicationConfigInjectionDelegator::class,
                ],
            ],
        ];
    }
}
