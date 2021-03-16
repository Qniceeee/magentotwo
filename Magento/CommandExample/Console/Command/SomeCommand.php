<?php

namespace Magento\CommandExample\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class SomeCommand
 * @package Magento\CommandExample\Console\Command
 * example of command engine
 */
class SomeCommand extends Command
{
    /**
     * Setting name and description for command
     */
    protected function configure()
    {
        $this->setName('command');
        $this->setDescription('This is my first console command.');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * print test text
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Довільний текст у вікні терміналу</info>');
    }
}
