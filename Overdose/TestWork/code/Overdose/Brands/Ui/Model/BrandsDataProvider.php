<?php

namespace Overdose\Brands\Ui\Model;

use Magento\Framework\App\Request\DataPersistorInterface;


/**
 * Class BrandsDataProvider
 * @package Overdose\Brands\Ui\Model
 */
class BrandsDataProvider extends \Magento\Ui\DataProvider\ModifierPoolDataProvider
{
    /**
     * @var \Overdose\Brands\Model\ResourceModel\Collection\Brands
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var \Overdose\Brands\Model\ResourceModel\Collection\BrandsFactory
     */
    private $collectionFactory;

    protected $loadedData;


    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        DataPersistorInterface $dataPersistor,
        \Overdose\Brands\Model\BrandRepository $collectionFactory,
        array $meta = [],
        array $data = [],
        \Magento\Ui\DataProvider\Modifier\PoolInterface $pool = null
    )
    {
        $this->collectionFactory = $collectionFactory;

        $this->collection = $collectionFactory->getBrandCollection();
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

        $data = $this->dataPersistor->get('overdose_brands');

        if (!empty($data)) {
            $item = $this->collection->getNewEmptyItem();
            $item->setData($data);
            $this->loadedData[$item->getId()] = $item->getData();


            $this->dataPersistor->clear('overdose_brands');
        }
        return $this->loadedData;
    }
}