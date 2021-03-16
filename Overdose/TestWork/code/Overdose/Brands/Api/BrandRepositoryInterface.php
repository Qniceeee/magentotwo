<?php
namespace Overdose\Brands\Api;

use Magento\Framework\Exception\CouldNotDeleteException;

interface BrandRepositoryInterface
{
    /**
     * @param \Overdose\Brands\Api\Data\BrandInterface|\Overdose\Brands\Model\Brands $model
     * @return \Overdose\Brands\Api\Data\BrandInterface|\Overdose\Brands\Model\Brands
     */
    public function save($model);


    /**
     * @param \Overdose\Brands\Api\Data\BrandInterface|\Overdose\Brands\Model\Brands $model
     * @return true
     * @throws CouldNotDeleteException
     */
    public function delete($model);


    /**
     * @param integer $id
     * @return \Overdose\Brands\Api\Data\BrandInterface|\Overdose\Brands\Model\Brands
     * @param
     */
    public function getById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteria $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList($searchCriteria);
}
