<?php

namespace Magento\CommandExample\Console\Command;

use Magento\Framework\App\Bootstrap;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class BaseUrl
 * @package Magento\CommandExample\Console\Command
 * some test command overdose
 */
class BaseUrl extends Command
{
    /**
     * Setting name and description for command
     */
    protected function configure()
    {
        $this->setName('url');
        $this->setDescription('This command show the base url.');
        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void
     * returned base url of you site/magento project
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        include('app/bootstrap.php');

        $bootstrap = Bootstrap::create(BP, $_SERVER);
        $objectManager = $bootstrap->getObjectManager();
        $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $baseUrl = $storeManager->getStore()->getBaseUrl();

        $output->writeln($baseUrl);
    }
}
