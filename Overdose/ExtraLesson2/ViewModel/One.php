<?php

namespace Overdose\ExtraLesson2\ViewModel;

class One implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function getNewPhrase()
    {
        return 'I am extra home work!';
    }
}