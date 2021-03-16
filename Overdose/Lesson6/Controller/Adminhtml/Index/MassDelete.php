<?php


namespace Overdose\Lesson6\Controller\Adminhtml\Index;


/**
 * Class MassDelete
 * @package Overdose\Lesson6\Controller\Adminhtml\Index
 */
class MassDelete extends \Magento\Backend\App\Action {

    /**
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $_filter;

    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory
     */
    protected $_collectionFactory;

    /**
     * MassDelete constructor.
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $collectionFactory
     * @param \Magento\Backend\App\Action\Context $context
     */
    public function __construct(
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $collectionFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
        $this->_filter            = $filter;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute() {
        try{

            $logCollection = $this->_filter->getCollection($this->_collectionFactory->create());

            foreach ($logCollection as $item) {
                $item->delete();
            }
            $this->messageManager->addSuccessMessage(__('Friends Deleted Successfully.'));
        }catch(\Exception $ex){
            $this->messageManager->addErrorMessage($ex->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/*/index');
    }

    /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed() {
        return $this->_authorization->isAllowed('Overdose_Lesson6::view');
    }
}