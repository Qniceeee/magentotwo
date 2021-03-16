<?php
namespace Overdose\Lesson6\Model\ResourceModel;



class Friends extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     *path to the db table
     */
    protected function _construct()
    {
        $this->_init('overdose_lesson6', 'id');
    }
}
