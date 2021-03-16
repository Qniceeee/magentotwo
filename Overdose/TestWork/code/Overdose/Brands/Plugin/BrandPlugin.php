<?php


namespace Overdose\Brands\Plugin;

use Magento\Framework\Exception\StateException;

/**
 * Class BrandPlugin
 * @package Overdose\Brands\Plugin
 */
class BrandPlugin
{

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var \Magento\Framework\Api\FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $productRepository;

    /**
     * BrandPlugin constructor.
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
     */
    public function __construct(
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository
    )
    {
        $this->logger = $logger;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
        $this->productRepository = $productRepository;
    }

    /**
     * @param \Overdose\Brands\Model\BrandRepository $subject
     * @param $result
     * @return mixed
     * @throws StateException
     */
    public function afterGetList(\Overdose\Brands\Model\BrandRepository $subject, $result)
    {
        try {

            $extensibleAttribute = [];
            foreach ($result->getItems() as $brand) {
                $brandName = $brand->getBrandName();
                $totalBrandProducts = $this->getTotalCountBrandProducts($brandName);
                $totalCustomDataOfProducts = ['total_brand_products' => $totalBrandProducts];
                $extensibleAttribute [] = $brand->setExtensionAttributes($totalCustomDataOfProducts);
            }

            $result->setItems($extensibleAttribute);

            return $result;

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new StateException(__('Some plugin error!!!'), $e);
        }
    }


    /**
     * @param $brand
     * @return int|void
     */
    public function getTotalCountBrandProducts($brand)
    {
        $filterBuilder = $this->filterBuilder
            ->setField('overdose_product_brands')
            ->setValue($brand)
            ->setConditionType('eq')
            ->create();

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilters([$filterBuilder])
            ->create();

        $products = $this->productRepository->getList($searchCriteria);

        $result = [];
        foreach ($products->getItems() as $count) {
            $result [] = $count['total_count'];
        }

        return count($result);
    }

    /**
     * @param \Overdose\Brands\Model\BrandRepository $subject
     * @param $result
     * @return mixed
     */
    public function afterGetById(\Overdose\Brands\Model\BrandRepository $subject, $result)
    {
        $brandName = $result->getBrandName();

        $totalBrandProducts = $this->getTotalCountBrandProducts($brandName);
        $totalCustomDataOfProducts = ['total_brand_products' => $totalBrandProducts];
        $result->setExtensionAttributes($totalCustomDataOfProducts);

        return $result;
    }
}

