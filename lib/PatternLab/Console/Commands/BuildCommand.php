<?php

namespace PatternLab\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

use PatternLab\Generator;

class BuildCommand extends Command
{

    protected function configure()
    {
        $this->setName('build')
             ->setDescription('Build your Pattern Lab')
             ->setHelp('No options');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $generator = new Generator($this->getApplication()->getConfig());

        $output->writeln('generating your site');

        $generator->generate();

    }
}