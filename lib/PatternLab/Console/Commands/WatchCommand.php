<?php

namespace PatternLab\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use PatternLab\Watcher;

class WatchCommand extends BuildCommand
{
    protected function configure()
    {
        $this->setName('watch')
             ->setDescription('Rebuild your Pattern Lab when a change is detected')
             ->setHelp('No options');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        parent::execute($input, $output);

        $watcher = new Watcher($this->getApplication()->getConfig());
        $output->writeln('now watching for changes...');
        $watcher->watch();

    }
}