<?php
namespace Overdose\Lesson4\Model\ResourceModel\Collection;

/**
 * Class Friends
 * @package Overdose\Lesson4\Model\ResourceModel\Collection
 */
class Friends extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     *paths to the model/resourcemodel
     */
    protected function _construct()
    {
        $this->_init(
            \Overdose\Lesson4\Model\Friends::class,
            \Overdose\Lesson4\Model\ResourceModel\Friends::class
        );
    }
}