<?php
namespace Overdose\Lesson3\Model\ResourceModel;

/**
 * Class Friends
 * @package Overdose\Lesson3\Model\ResourceModel
 */
class Friends extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *path to the db table
     */
    protected function _construct()
    {
        $this->_init('overdose_lesson3', 'id');
    }
}