<?php
namespace Overdose\Lesson3\Model;

/**
 * Class Friends
 * @package Overdose\Lesson3\Model
 */
class Friends extends \Magento\Framework\Model\AbstractModel
{
    /**
     *path to the resource model?
     */
    protected function _construct()
    {
        $this->_init(\Overdose\Lesson3\Model\ResourceModel\Friends::class);
    }
}