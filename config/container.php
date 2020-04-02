<?php

declare(strict_types=1);

// Load configuration
use Laminas\ServiceManager\ServiceManager;

$config = require __DIR__ . '/config.php';
$dependencies                       = $config['dependencies'];
$dependencies['services']['config'] = $config;

// Build container
return new ServiceManager($dependencies);
