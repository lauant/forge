#! /usr/bin/env php

<?php

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

require 'vendor/autoload.php';

$app = new Application( "Lauant Scaffolding Tool" );

$app->register('init')
    ->setDescription("Initialize a WP plugin with a set of options")
    ->addArgument('name', InputArgument::REQUIRED, 'Name of WP Plugin' )
    ->setCode( function( InputInterface $input, OutputInterface $output ){
        $pluginName = $input->getArgument('pluginName');
        $output->writeln( "hello");

    });

$app->run();