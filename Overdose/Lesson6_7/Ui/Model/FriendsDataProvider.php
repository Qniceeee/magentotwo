<?php

namespace Overdose\Lesson6\Ui\Model;

use Magento\Framework\App\Request\DataPersistorInterface;

/**
 * Class FriendsDataProvider
 * @package Overdose\Lesson6\Ui\Model
 */
class FriendsDataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Collection\Friends
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;


    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory
     */
    private $collectionFactory;

    /**
     * @var
     */
    protected $loadedData;

    /**
     * FriendsDataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param DataPersistorInterface $dataPersistor
     * @param \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $collectionFactory
     * @param array $meta
     * @param array $data
     * @param \Magento\Ui\DataProvider\Modifier\PoolInterface|null $pool
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        \Overdose\Lesson6\Model\ResourceModel\Collection\FriendsFactory $collectionFactory,
        array $meta = [],
        array $data = [],
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool = null
    )
    {
        $this->collectionFactory = $collectionFactory;

        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data,
            $pool
        );
    }

    /**
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $item) {
            $this->loadedData[$item->getId()] = $item->getData();
        }

        $data = $this->dataPersistor->get('overdose_friends');

        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($data);
            $this->loadedData[$item->getId()] = $item->getData();


            $this->dataPersistor->clear('overdose_friends');
        }
        return $this->loadedData;
    }
}