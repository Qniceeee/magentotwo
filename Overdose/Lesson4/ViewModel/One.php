<?php

namespace Overdose\Lesson4\ViewModel;


/**
 * Class One
 * @package Overdose\Lesson4\ViewModel
 */
class One implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    protected $friendsFactory;

    protected $friendsCollectionFactory;

    protected $friendsResourceModel;

    public function __construct(
        \Overdose\Lesson4\Model\FriendsFactory $friendsFactory,
        \Overdose\Lesson4\Model\ResourceModel\Friends $friendsResourceModel,
        \Overdose\Lesson4\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
    )
    {
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory =$friendsCollectionFactory;
    }

    public function getNewPhrase()
    {
        return 'I am lesson4!';
    }

    public function getName($name)
    {
        return 'I am ' . $name . ', I am boss!';
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

    /**
     * @return \Magento\Framework\DataObject[]
     */
    public function showFriendsList()
    {
        $collection = $this->friendsCollectionFactory->create();

        return $collection->getItems();
    }
}