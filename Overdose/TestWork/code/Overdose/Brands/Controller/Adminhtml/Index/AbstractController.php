<?php
namespace Overdose\Brands\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

/**
 * Class AbstractController
 * @package Overdose\Brands\Controller\Adminhtml\Index
 */
abstract class AbstractController extends \Magento\Backend\App\Action
{
    /**
     *
     */
    const DEFAULT_ACTION_PATH = 'brands/index/';

    /**
     * @var \Overdose\Brands\Model\BrandRepository
     */
    protected $brands;

    /**
     * AbstractController constructor.
     * @param Action\Context $context
     * @param \Overdose\Brands\Model\BrandRepository $brands
     */
    public function __construct(
        Action\Context $context,
        \Overdose\Brands\Model\BrandRepository $brands

    ) {
        parent::__construct($context);
        $this->brands = $brands;
    }
}
