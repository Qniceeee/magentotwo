<?php

namespace Overdose\Lesson6\ViewModel;


/**
 * Class One
 * @package Overdose\Lesson6\ViewModel
 */
class One implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Overdose\Lesson6\Model\FriendsFactory
     */
    protected $friendsFactory;

    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory
     */
    protected $friendsCollectionFactory;

    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Friends
     */
    protected $friendsResourceModel;

    /**
     * One constructor.
     * @param \Overdose\Lesson6\Model\FriendsFactory $friendsFactory
     * @param \Overdose\Lesson6\Model\ResourceModel\Friends $friendsResourceModel
     * @param \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
     */
    public function __construct(
        \Overdose\Lesson6\Model\FriendsFactory $friendsFactory,
        \Overdose\Lesson6\Model\ResourceModel\Friends $friendsResourceModel,
        \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $friendsCollectionFactory
    )
    {
        $this->friendsFactory = $friendsFactory;
        $this->friendsResourceModel = $friendsResourceModel;
        $this->friendsCollectionFactory =$friendsCollectionFactory;
    }

    /**
     * @param $name
     * @return string
     */
    public function getName($name)
    {
        return __('I am ') . $name . __(', I am boss!');
    }

    /**
     *just testing some functional
     */
    public function testForMySelf()
    {
    /*  $model = $this->friendsFactory->create();

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