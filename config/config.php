<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;
use Laminas\ConfigAggregator\PhpFileProvider;

$aggregator = new ConfigAggregator(
    [
        \Mezzio\ConfigProvider::class,
        \Mezzio\Helper\ConfigProvider::class,
        \Mezzio\Router\ConfigProvider::class,
        \Mezzio\Router\FastRouteRouter\ConfigProvider::class,

        // Enable the Movies module's ConfigProvider
        Movies\ConfigProvider::class,

        new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
    ]
);

return $aggregator->getMergedConfig();
