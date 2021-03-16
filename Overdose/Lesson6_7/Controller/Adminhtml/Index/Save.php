<?php

namespace Overdose\Lesson6\Controller\Adminhtml\Index;

use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class Save
 * @package Overdose\Lesson6\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const ADMIN_RESOURCE = "Overdose_Lesson6::overdose_edit";

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Overdose\Lesson6\Model\FriendsFactory
     */
    private $friendsFactory;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Overdose\Lesson6\Model\FriendsFactory $friendsFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Overdose\Lesson6\Model\FriendsFactory $friendsFactory,
        DataPersistorInterface $dataPersistor
    )
    {
        $this->friendsFactory = $friendsFactory;
        parent::__construct($context);
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $yourModel = $this->friendsFactory->create();
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }

            if ($id) {
                $yourModel->load($id);
            }

            $yourModel->setData($data);

            try {
                $yourModel->save();
                $this->messageManager->addSuccessMessage(__('Record SucessFully Update'));

                $this->dataPersistor->clear('overdose_friends');

                return $resultRedirect->setPath('*/*/edit', ['id' => $yourModel->getId()]);

            } catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage($exception, __('Something Went to Wrong While save data'));
            }
            $this->dataPersistor->set('overdose_friends', $data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/index');
    }

}