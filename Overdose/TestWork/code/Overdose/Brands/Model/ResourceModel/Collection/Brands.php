<?php
namespace Overdose\Brands\Model\ResourceModel\Collection;

/**
 * Class Brands
 * @package Overdose\Brands\Model\ResourceModel\Collection
 */
class Brands extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     *
     */
    protected function _construct()
    {
        $this->_init(
            \Overdose\Brands\Model\Brands::class,
            \Overdose\Brands\Model\ResourceModel\Brands::class
        );
    }
}