#!/usr/bin/env php
<?php

set_time_limit(0);

require __DIR__ . '/../vendor/autoload.php';

Mustache_Autoloader::register();

$configLocation = __DIR__ . '/../config/config.ini';

if (!file_exists($configLocation)) {
    throw new Exception('A configuration file is required. Look at config/config.ini.default for an example!');
}

$config = parse_ini_file($configLocation);

if (!$config) {
    throw new Exception("The supplied configuration file at {$configLocation} is invalid. Please see config.ini.default in the same directory for an example");
}

$app = new PatternLab\Console\Application;
$app->setConfig($config);
$app->run();
