<?php

namespace Overdose\Practice\ViewModel;

class Time implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @return string
     * current time for time.phtml Global block
     */
    public function showTime()
    {
        return 'Current time is' . '<br>'. (date("G:i:s"));
    }
}