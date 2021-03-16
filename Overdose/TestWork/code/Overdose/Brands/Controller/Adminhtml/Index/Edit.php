<?php

namespace Overdose\Brands\Controller\Adminhtml\Index;


use Overdose\Brands\Api\Data\BrandInterface;

/**
 * Class Edit
 * @package Overdose\Brands\Controller\Adminhtml\Index
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
     * @var \Overdose\Brands\Model\BrandRepository
     */
    private $brandsFactory;


    /**
     *
     */
    const ADMIN_RESOURCE = "Overdose_Brands::overdose_edit";


    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Overdose\Brands\Model\BrandRepository $brandsFactory
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct
    (

        \Magento\Backend\App\Action\Context $context,
        \Overdose\Brands\Model\BrandRepository $brandsFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Registry $registry
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->brandsFactory = $brandsFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $brands = $this->brandsFactory->getBrandModel();

        $id = $this->getRequest()->getParam('id');

        if ($id) {

            $brands->load($id);

            if (!$brands->getId()) {
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/index');
            }
        }

        $this->registry->register('overdose', $brands);

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->setKeywords(__('Edit Page'));

        $resultPage->setActiveMenu('Overdose_Brands::overdose');

        $resultPage->getConfig()->getTitle()->prepend('Brands Module');
        $pageTitlePrefix = __('Edit Page for %1',
            $brands->getId() ? $brands->getId() : __('New entry')
        );
        $resultPage->getConfig()->getTitle()->prepend($pageTitlePrefix);

        return $resultPage;
    }
}