<?php

namespace PatternLab\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class Application extends BaseApplication
{

    private $config = array();

    public function __construct()
    {
        parent::__construct();

        $this->addCommands(array(
            new Commands\BuildCommand,
            new Commands\WatchCommand
        ));
    }
    protected function getDefaultInputDefinition()
    {
        return new InputDefinition(array(
            new InputArgument('command', InputArgument::REQUIRED, 'The command to execute'),

            new InputOption('--help',           '-h', InputOption::VALUE_NONE, 'Display this help message.'),
            new InputOption('--version',        '-V', InputOption::VALUE_NONE, 'Display this application version.'),
        )); 
    }

    public function setConfig($config=array())
    {
        $this->config = $config;
    }

    public function getConfig()
    {
        return $this->config;
    }
}