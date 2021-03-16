<?php

namespace Overdose\ExtraLesson3\ViewModel;



class One implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $friendsFactory;

    protected $friendsCollectionFactory;

    protected $friendsResourceModel;

    public function __construct(
        \Overdose\Lesson3\Model\FriendsFactory $friendsFactory,
        \Overdose\Lesson3\Model\ResourceModel\Friends $friendsResourceModel,
        \Overdose\Lesson3\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
    )
    {
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory =$friendsCollectionFactory;
    }

    public function getNewPhrase()
    {
        return 'I am lesson3 EXTRA !';
    }

}