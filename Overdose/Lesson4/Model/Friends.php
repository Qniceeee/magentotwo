<?php
namespace Overdose\Lesson4\Model;

/**
 * Class Friends
 * @package Overdose\Lesson4\Model
 */
class Friends extends \Magento\Framework\Model\AbstractModel
{
    /**
     *path to the resource model?
     */
    protected function _construct()
    {
        $this->_init(\Overdose\Lesson4\Model\ResourceModel\Friends::class);
    }
}