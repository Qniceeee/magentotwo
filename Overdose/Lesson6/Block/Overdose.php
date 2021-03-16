<?php

namespace Overdose\Lesson6\Block;

/**
 * Class Overdose
 * @package Overdose\Lesson6\Block
 */
class Overdose extends \Magento\Framework\View\Element\Template
{
    /**
     * @return string
     */
    public function doSome()
    {
        return __('I am do some on Lesson 6');
    }
}