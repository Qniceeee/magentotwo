<?php
namespace Overdose\Lesson6\Block\Adminhtml\Edit\Form;

/**
 * Class GenericButton
 * @package Overdose\Lesson6\Block\Adminhtml\Edit\Form
 */
class GenericButton
{
    /**
     * @var \Magento\Backend\Block\Widget\Context
     */
    private $context;

    /**
     * @var \Overdose\Lesson6\Model\FriendsFactory
     */
    private $friendsFactory;

    /**
     * GenericButton constructor.
     * @param \Overdose\Lesson6\Model\FriendsFactory $friendsFactory
     * @param \Magento\Backend\Block\Widget\Context $context
     */
    public function __construct(
        \Overdose\Lesson6\Model\FriendsFactory $friendsFactory,
        \Magento\Backend\Block\Widget\Context  $context
    ) {

        $this->friendsFactory = $friendsFactory;
        $this->context = $context;
    }

    /**
     * @return false|mixed
     */
    public function getId()
    {
        /**
         * Get Url param  value
         */
        if($this->context->getRequest()->getParam('id')){
            $friendsModel =$this->friendsFactory->create();
            $friendsModel->load($this->context->getRequest()->getParam('id'));

            return $friendsModel->getId();
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