<?php

namespace Overdose\Lesson6\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class add customer example attribute to customer
 */
class AddNewConfigurableProduct implements DataPatchInterface
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    protected $moduleDataSetup;


    /**
     * AddNewConfigurableProduct constructor.
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->logger = $logger;
        $this->moduleDataSetup = $moduleDataSetup;
    }


    /**
     *
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $configurable_product = $objectManager->create('\Magento\Catalog\Model\Product');

        $configurable_product->setSku('CONFIG_SKU');
        $configurable_product->setName('CONFIG PRODUCT NAME');
        $configurable_product->setAttributeSetId(4);
        $configurable_product->setStatus(1);
        $configurable_product->setTypeId('configurable');
        $configurable_product->setPrice(0);
        $configurable_product->setWebsiteIds([1]);
        $configurable_product->setCategoryIds([2]);
        $configurable_product->setStockData([
                'use_config_manage_stock' => 0,
                'manage_stock' => 1,
                'is_in_stock' => 1,
            ]
        );


        $configurableAttributesData = $configurable_product->getTypeInstance()->getConfigurableAttributesAsArray($configurable_product);
        $configurable_product->setCanSaveConfigurableAttributes(true);
        $configurable_product->setConfigurableAttributesData($configurableAttributesData);
        $configurableProductsData = [];
        $configurable_product->setConfigurableProductsData($configurableProductsData);
        try {
            $configurable_product->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        $productId = $configurable_product->getId();

        $associatedProductIds = [2094, 2095, 2096];

        try {
            $configurable_product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId);
            $configurable_product->setAssociatedProductIds($associatedProductIds);
            $configurable_product->setCanSaveConfigurableAttributes(true);
            $configurable_product->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return string[]
     */
    public static function getDependencies()
    {
        return [
            AddNewSimpleProduct3::class,
        ];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }

}