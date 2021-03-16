<?php

namespace Overdose\ExtraLesson2\Controller\Customer;

use Magento\Framework\Controller\ResultFactory;

/**
 * Class Login
 * @package Overdose\ExtraLesson2\Controller\Customer
 */
class Login extends \Magento\Framework\App\Action\Action
{
    /**
     * @var ResultFactory
     */
    protected $resultFactory;

    /**
     * Login constructor.
     * @param ResultFactory $resultFactory
     * @param \Magento\Framework\App\Action\Context $context
     */
    public function __construct(
        \Magento\Framework\Controller\ResultFactory $resultFactory,
        \Magento\Framework\App\Action\Context $context
    )
    {
        $this->resultFactory = $resultFactory;

        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $redirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl('/overdose/customer/account');

        return $redirect;
    }
}
