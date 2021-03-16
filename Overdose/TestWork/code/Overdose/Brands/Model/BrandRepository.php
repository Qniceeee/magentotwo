<?php

namespace Overdose\Brands\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;


/**
 * Class BrandRepository
 * @package Overdose\Brands\Model
 */
class BrandRepository implements \Overdose\Brands\Api\BrandRepositoryInterface
{
    /**
     * @var \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var \Magento\Framework\Api\SearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var BrandsFactory
     */
    protected $brandsFactory;


    /**
     * @var ResourceModel\Brands
     */
    protected $brandsResourceModel;

    /**
     * @var ResourceModel\Collection\BrandsFactory
     */
    protected $brandsCollectionFactory;

    /**
     * BrandRepository constructor.
     * @param BrandsFactory $brandsFactory
     * @param ResourceModel\Brands $brandsResourceModel
     * @param ResourceModel\Collection\BrandsFactory $brandsCollectionFactory
     * @param \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor
     * @param \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct
    (
        \Overdose\Brands\Model\BrandsFactory $brandsFactory,
        \Overdose\Brands\Model\ResourceModel\Brands $brandsResourceModel,
        \Overdose\Brands\Model\ResourceModel\Collection\BrandsFactory $brandsCollectionFactory,
        \Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface $collectionProcessor,
        \Magento\Framework\Api\SearchResultsInterfaceFactory $searchResultsFactory
    )
    {
        $this->brandsFactory = $brandsFactory;
        $this->brandsResourceModel = $brandsResourceModel;
        $this->brandsCollectionFactory = $brandsCollectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;

    }

    /**
     * @param \Overdose\Brands\Api\Data\BrandInterface|Brands $model
     * @return \Overdose\Brands\Api\Data\BrandInterface|Brands|void
     * @throws CouldNotSaveException
     */
    public function save($model)
    {
        try {
            $this->brandsResourceModel->save($model);
        }catch ( \Exception $e)
        {
            throw new CouldNotSaveException(__('Sorry, cant save your brand! ' . $e->getMessage() ) );
        }
    }

    /**
     * @param \Overdose\Brands\Api\Data\BrandInterface|Brands $model
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete($model)
    {
        try {
            $this->brandsResourceModel->delete($model);
            return true;
        }catch ( \Exception $e)
        {
            throw new CouldNotDeleteException(__('Sorry, cant delete your brand! ' . $e->getMessage() ) );
        }
    }

    /**
     * @param int $id
     * @return \Overdose\Brands\Api\Data\BrandInterface|Brands
     * @throws NoSuchEntityException
     */
    public function getById($id)
    {
        try {
            $model = $this->brandsFactory->create();
            $this->brandsResourceModel->load($model, $id);

            return $model;
        }catch ( \Exception $e)
        {
            throw new NoSuchEntityException(__('Sorry, cant get your brand %1! ' . $e->getMessage() ) );
        }
    }

    /**
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList($searchCriteria)
    {
        $collection = $this->brandsCollectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * @return \Overdose\Brands\Model\Brands
     */
    public function getBrandModel()
    {
        return $this->brandsFactory->create();
    }

    /**
     * @return \Overdose\Brands\Model\ResourceModel\Collection\Brands
     */
    public function getBrandCollection()
    {
        return $this->brandsCollectionFactory->create();
    }

}