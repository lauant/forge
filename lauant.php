#! /usr/bin/env php

<?php

use Lauant\Forge\Symfony\Component\Console\Application;
use Lauant\Forge\InitializeCommand;

require 'vendor/autoload.php';

$app = new Application( "Lauant Scaffolding Tool", '0.1' );

$app->add( new InitializeCommand() );

$app->run();