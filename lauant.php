#! /usr/bin/env php

<?php

use Symfony\Component\Console\Application;
use Lauant\CMD\InitializeCommand;

require 'vendor/autoload.php';

$app = new Application( "Lauant Scaffolding Tool", '0.1' );

$app->add( new InitializeCommand() );

$app->run();