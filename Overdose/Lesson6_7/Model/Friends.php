<?php
namespace Overdose\Lesson6\Model;

/**
 * Class Friends
 * @package Overdose\Lesson6\Model
 */
class Friends extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'friend_model_event_some';

    /**
     *path to the resource model?
     */
    protected function _construct()
    {
        $this->_init(\Overdose\Lesson6\Model\ResourceModel\Friends::class);
    }
}