<?php

declare(strict_types=1);

use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Movies\BasicRenderer;
use Psr\Http\Message\ServerRequestInterface;
use \Movies\Middleware\RenderMoviesMiddleware;

chdir(dirname(__DIR__));
require 'vendor/autoload.php';

/**
 * Self-called anonymous function that creates its own scope and keep the global namespace clean.
 */
(function () {
    /** @var \Psr\Container\ContainerInterface $container */
    $container = require 'config/container.php';
    $container->setFactory('MovieData', function() {
        return include 'data/movies.php';
    });

    /** @var Application $app */
    $app = $container->get(
        Application::class
    );

    $factory = $container->get(
        MiddlewareFactory::class
    );

    (require 'config/pipeline.php')($app, $factory, $container);

    $movieData = $container->get('MovieData');

    $app->get(
        '/',
        function (ServerRequestInterface $request) use ($movieData) {
            return new HtmlResponse(
                (new BasicRenderer())(
                    $movieData
                )
            );
        }
    );

    $app->run();
})();
