<?php

namespace Overdose\Lesson6\Plugin;


class NewPlugin
{

    public function afterSimpleTextToTheShell(\Overdose\Lesson6\ViewModel\One $collection)
    {
        return __('Now this text came from the after plugin, and NOT the viewModel class.');
    }

}