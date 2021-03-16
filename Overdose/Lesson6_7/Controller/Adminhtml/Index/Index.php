<?php

namespace Overdose\Lesson6\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Index extends AbstractController
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(__('Hello =)'));

        return $resultPage;
    }

    /**
     * {@inheritdoc}
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Overdose_Lesson6::overdose');
    }
}
