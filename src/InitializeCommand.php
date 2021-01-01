<?php 

namespace Lauant\CMD;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeCommand extends Command {

    public function configure(){
       $this->setName( 'init' )
            ->setDescription('Initial WP plugin')
            ->addArgument('pluginName', InputArgument::REQUIRED, 'Name of WP Plugin' );
    }

    public function execute( InputInterface $input, OutputInterface $output ){
        $pluginName = $input->getArgument('pluginName');
        $output->writeln( "Initializing " . $pluginName );
    }
}