<?php

namespace Overdose\Lesson6\Model\Attribute\Backend;

/**
 * Class MyAttributeBackend
 * @package Overdose\Lesson6\Model\Attribute\Backend
 */
class MyAttributeBackend extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{

    /**
     * @param $object
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function validate($object)
    {
        $attrCode = $this->getAttribute()->getAttributeCode();
        $value = $object->getData($attrCode);

        if ($value < 0 || $value > 5.0) {

            throw new \Magento\Framework\Exception\LocalizedException(
                __('Please enter a number from 0 to 5.')
            );
        }
        return true;
    }
}
