<?php


namespace Overdose\Lesson6\Controller\Adminhtml\Index;


class Delete extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = "Overdose_Lesson6::overdose_delete";


    private $friendsFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Overdose\Lesson6\Model\FriendsFactory $friendsFactory
    )
    {
        $this->friendsFactory = $friendsFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('id');

        if ($id)
        {
            $friendsModel = $this->friendsFactory->create();
            $friendsModel->load($id);

            if ($friendsModel->getId())
            {

                try {
                    $friendsModel->delete();
                    $this->messageManager->addSuccessMessage(__('The record has been delete successfully'));
                } catch (\Exception $ex) {
                    $this->messageManager->addErrorMessage(__('Something wento to wrong while Delete'));
                }

                return $resultRedirect->setPath('*/*/index');
            }

        }
        $this->messageManager->addErrorMessage(__('The Record does not exits'));

        return $resultRedirect->setPath('*/*/index');
    }

}