<?php

namespace Overdose\Brands\Model\Attribute\Source;


/**
 * Class BrandsAttributeSource
 * @package Overdose\Brands\Model\Attribute\Source
 */
class BrandsAttributeSource extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var \Overdose\Brands\Model\BrandRepository
     */
    protected $brandRepository;

    /**
     * BrandsAttributeSource constructor.
     * @param \Overdose\Brands\Model\BrandRepository $brandRepository
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Overdose\Brands\Model\BrandRepository $brandRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->brandRepository = $brandRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return array|null
     */
    public function getAllOptions()
    {
        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('id','0','gt')
            ->create();

        $brands =  $this->brandRepository->getList($searchCriteria);


        if (!$this->_options)
        {
            foreach ($brands->getItems() as $brand) {
                $this->_options [] = ['label' => __($brand->getBrandName()), 'value'=>$brand->getBrandTitle()];
            }
        }
        return $this->_options;
    }


}