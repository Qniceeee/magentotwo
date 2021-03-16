<?php

namespace Overdose\Lesson6\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class AddAssociated
 * @package Overdose\Lesson6\Setup\Patch\Data
 */
class AddAssociated implements DataPatchInterface
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
     * AddAssociated constructor.
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
     *add associated
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $productId = 297; // Configurable Product Id
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $product = $objectManager->create('Magento\Catalog\Model\Product')->load($productId); // Load Configurable Product
        $attributeModel = $objectManager->create('Magento\ConfigurableProduct\Model\Product\Type\Configurable\Attribute');
        $position = 0;
        $attributes = [134, 135]; // Super Attribute Ids Used To Create Configurable Product
        $associatedProductIds = [2094, 2095, 2096]; //Product Ids Of Associated Products
        foreach ($attributes as $attributeId) {
            $data = array('attribute_id' => $attributeId, 'product_id' => $productId, 'position' => $position);
            $position++;
            $attributeModel->setData($data)->save();
        }
        $product->setTypeId("configurable"); // Setting Product Type As Configurable
        $product->setAffectConfigurableProductAttributes(4);
        $objectManager->create('Magento\ConfigurableProduct\Model\Product\Type\Configurable')->setUsedProductAttributeIds($attributes, $product);
        $product->setNewVariationsAttributeSetId(4); // Setting Attribute Set Id
        $product->setAssociatedProductIds($associatedProductIds);// Setting Associated Products
        $product->setCanSaveConfigurableAttributes(true);
        $product->save();

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [
            AddNewConfigurableProduct::class
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