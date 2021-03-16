<?php
namespace Overdose\Lesson6\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\App\Config\ScopeConfigInterface;

abstract class AbstractController extends \Magento\Backend\App\Action
{
    const DEFAULT_ACTION_PATH = 'myroute/index/';

    protected $friends;
    public function __construct(
        Action\Context $context,
        \Overdose\Lesson6\Model\ResourceModel\Friends $friends

    ) {
        parent::__construct($context);
        $this->friends = $friends;
    }
}
