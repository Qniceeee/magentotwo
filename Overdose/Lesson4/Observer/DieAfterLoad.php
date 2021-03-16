<?php

namespace Overdose\Lesson4\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Class DieAfterLoad
 * @package Overdose\Lesson4\Observer
 */
class DieAfterLoad implements ObserverInterface
{
    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        die(__('This Привет page now DIE :)'));
    }
}

