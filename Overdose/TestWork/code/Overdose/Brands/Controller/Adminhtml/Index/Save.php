<?php

namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Framework\App\Request\DataPersistorInterface;


/**
 * Class Save
 * @package Overdose\Brands\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{

    /**
     *
     */
    const ADMIN_RESOURCE = "Overdose_Brands::overdose_edit";


    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;


    /**
     * @var \Overdose\Brands\Model\BrandRepository
     */
    private $brandsFactory;


    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Overdose\Brands\Model\BrandRepository $brandsFactory
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Overdose\Brands\Model\BrandRepository $brandsFactory,
        DataPersistorInterface $dataPersistor
    )
    {
        $this->brandsFactory = $brandsFactory;
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
            $brandsModel = $this->brandsFactory->getBrandModel();
            $id = $this->getRequest()->getParam('id');

            if (empty($data['id'])) {
                $data['id'] = null;
            }

            if ($id) {
                $brandsModel->load($id);
            }

            $brandsModel->setData($data);

            try {
                $brandsModel->save();
                $this->messageManager->addSuccessMessage(__('Record SucessFully Update'));

                $this->dataPersistor->clear('overdose_friends');

                return $resultRedirect->setPath('*/*/edit', ['id' => $brandsModel->getId()]);

            } catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage($exception, __('Something Went to Wrong While save data'));
            }
            $this->dataPersistor->set('overdose_friends', $data);

            return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
        }
        return $resultRedirect->setPath('*/*/index');
    }

}