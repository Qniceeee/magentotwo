<?php

namespace Overdose\Brands\Model\ResourceModel;

use Overdose\Brands\Api\Data\BrandInterface;

/**
 * Class Brands
 * @package Overdose\Brands\Model\ResourceModel
 */
class Brands extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *
     */
    protected function _construct()
    {
        $this->_init(BrandInterface::TABLE_NAME, BrandInterface::FIELD_NAME_ID);
    }
}