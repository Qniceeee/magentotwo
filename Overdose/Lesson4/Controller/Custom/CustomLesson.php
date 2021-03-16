<?php

namespace Overdose\Lesson4\Controller\Custom;

/**
 * Class CustomLesson
 * @package Overdose\Lesson4\Controller\Custom
 */
class CustomLesson extends \Magento\Framework\App\Action\Action
{
    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $this->_eventManager->dispatch('custom_load_of_data');
    }
}
