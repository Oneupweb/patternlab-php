<?php

/*!
 * Pattern Lab Builder CLI - v0.6.2
 *
 * Copyright (c) 2013 Dave Olsen, http://dmolsen.com
 * Licensed under the MIT license
 *
 * Usage:
 *
 *     php builder.php -g
 *         Iterates over the 'source' directories & files and generates the entire site a single time.
 *         It also cleans the 'public' directory.
 * 
 *     php builder.php -w
 *         Generates the site like the -g flag and then watches for changes in the 'source' directories &
 *         files. Will re-generate files if they've changed.
 *
 */

require __DIR__ . '/../vendor/autoload.php';



Mustache_Autoloader::register();


// make sure this script is being accessed from the command line
if (php_sapi_name() !== 'cli') {
    throw new Exception('The builder script can only be run from the command line.');
}

$configLocation = __DIR__ . '/../config/config.ini';

if (!file_exists($configLocation)) {
    throw new Exception('A configuration file is required. Look at config/config.ini.default for an example!');
}

$config = parse_ini_file($configLocation);

if (!$config) {
    throw new Exception("The supplied configuration file at {$configLocation} is invalid. Please see config.ini.default in the same directory for an example");
}

$args = getopt("gwc");

if (isset($args['g']) || isset($args['w'])) {

    // initiate the g (generate) switch

    // iterate over the source directory and generate the site
    $g = new Generatr($config);

    echo "your site has been generated...\n";

    $g->generate();

}

if (isset($args['w'])) {
    // watch the source directory and regenerate any changed files
    $w = new Watchr($config);
    echo "watching your site for changes...\n";
    $w->watch();

}


if (!isset($args['w']) && !isset($args['g'])) {

    // when in doubt write out the usage
    echo "\n";
    echo "Usage:\n\n";
    echo "  php ".$_SERVER["PHP_SELF"]." -g\n";
    echo "    Iterates over the 'source' directories & files and generates the entire site a single time.\n";
    echo "    It also cleans the 'public' directory.\n\n";
    echo "  php ".$_SERVER["PHP_SELF"]." -w\n";
    echo "    Generates the site like the -g flag and then watches for changes in the 'source' directories &\n";
    echo "    files. Will re-generate files if they've changed.\n\n";

}
