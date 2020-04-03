<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Movies\Middleware\RenderMoviesMiddlewareFactory;
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

    (require 'config/routes.php')(
        $app, $factory, $container
    );

    $app->run();
})();
