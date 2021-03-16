<?php
namespace Overdose\Brands\Block\Adminhtml\Edit\Form;


/**
 * Class GenericButton
 * @package Overdose\Brands\Block\Adminhtml\Edit\Form
 */
class GenericButton
{
    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    private $context;

    /**
     * @var \Overdose\Brands\Model\BrandRepository
     */
    private $brandsFactory;

    /**
     * GenericButton constructor.
     * @param \Overdose\Brands\Model\BrandRepository $brandsFactory
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Overdose\Brands\Model\BrandRepository $brandsFactory,
        \Magento\Backend\Block\Widget\Context  $context
    ) {

        $this->brandsFactory = $brandsFactory;
        $this->context = $context;
    }


    /**
     * @return false|mixed|null
     */
    public function getId()
    {

        if($this->context->getRequest()->getParam('id')){
            $brandsModel =$this->brandsFactory->getBrandModel();
            $brandsModel->load($this->context->getRequest()->getParam('id'));

            return $brandsModel->getId();
        }
        return false;
    }

    /**
     * @return \Magento\Framework\UrlInterface
     */
    public function getUrlBuilder()
    {
        return $this->context->getUrlBuilder();
    }
}