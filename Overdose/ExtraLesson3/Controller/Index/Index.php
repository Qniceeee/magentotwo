<?php

namespace Overdose\ExtraLesson3\Controller\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends \Magento\Framework\App\Action\Action
{
    public function execute()
    {
        $page = $this->resultFactory->create( ResultFactory::TYPE_PAGE);

        return $page;
    }
}
