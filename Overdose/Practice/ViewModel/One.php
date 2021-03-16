<?php

namespace Overdose\Practice\ViewModel;

class One implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getNewPhrase()
    {
        return 'i am good vievModel!!! rly good';
    }
}