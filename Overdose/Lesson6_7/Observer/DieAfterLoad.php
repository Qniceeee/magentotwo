<?php

namespace Overdose\Lesson6\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class DieAfterLoad
 * @package Overdose\Lesson6\Observer
 */
class DieAfterLoad implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        die(__('This page now DIE :)'));
    }
}

