<?php

namespace Overdose\Lesson4\Plugin;

class NewPlugin
{
    public function aroundGetName()
    {
        return 'Toni Boss!';
    }
}