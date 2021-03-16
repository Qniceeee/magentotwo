<?php

namespace Overdose\Lesson3\ViewModel;



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
        return 'I am lesson3!';
    }

    /**
     *just testing some functional
     */
    public function testForMySelf(){
/*    $model = $this->friendsFactory->create();

        $model->setData('name','ivan')
            ->setData('age','12')
            ->setData('notes','ivan ok bro');

        $this->friendsResourceModel->save($model);*/

        return 'script off';
    }

    public function showFriendsList()
    {
        $collection = $this->friendsCollectionFactory->create();

        return $collection->getItems();
    }
}