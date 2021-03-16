<?php

namespace Overdose\Lesson6\Controller\Adminhtml\Index;

/**
 * Class Edit
 * @package Overdose\Lesson6\Controller\Adminhtml\Index
 */
class Edit extends \Magento\Backend\App\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;


    /**
     * @var \Magento\Framework\Registry
     */
    protected $registry;

    /**
     * @var \Overdose\Lesson6\Model\FriendsFactory
     */
    private $friendsFactory;


    /**
     *
     */
    const ADMIN_RESOURCE = "Overdose_Lesson6::overdose_edit";

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Overdose\Lesson6\Model\FriendsFactory $friendsFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct
    (

        \Magento\Backend\App\Action\Context $context,
        \Overdose\Lesson6\Model\FriendsFactory $friendsFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->friendsFactory = $friendsFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $friends = $this->friendsFactory->create();

        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $friends->load($id);

            if (!$friends->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }

        $this->registry->register('overdose', $friends);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));

        $resultPage->setActiveMenu('Overdose_Lesson6::overdose');

        $resultPage->getConfig()->getTitle()->prepend('Example Module');
        $pageTitlePrefix = __('Edit Page for %1',
            $friends->getId() ? $friends->getId() : __('New entry')
        );
        $resultPage->getConfig()->getTitle()->prepend($pageTitlePrefix);

        return $resultPage;
    }
}