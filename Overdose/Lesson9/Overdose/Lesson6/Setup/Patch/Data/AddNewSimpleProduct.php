<?php

namespace Overdose\Lesson6\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;

/**
 * Class add customer example attribute to customer
 */
class AddNewSimpleProduct implements DataPatchInterface
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
     * AddNewSimpleProduct constructor.
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
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function apply()
    {

       $this->moduleDataSetup->getConnection()->startSetup();

            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

            $app_state = $objectManager->get('\Magento\Framework\App\State');
        /**
         * @var \Magento\Framework\App\State $app_state
         */
            $app_state->setAreaCode('frontend');

            $set_product = $objectManager->create('\Magento\Catalog\Model\Product');

            try{
                $set_product->setWebsiteIds([1]);
                $set_product->setAttributeSetId(4);
                $set_product->setTypeId('simple');
                $set_product->setCreatedAt(strtotime('now'));
                $set_product->setName('Test Sample Products #1');
                $set_product->setSku('CONFIG_SKU');
                $set_product->setWeight(1.0000);
                $set_product->setStatus(1);
                $category_id= [4,5];
                $set_product->setCategoryIds($category_id);
                $set_product->setTaxClassId(0);
                $set_product->setVisibility(4);
                $set_product->setManufacturer(28);
                $set_product->setColor(24);
                $set_product->setImage('/testimg/test.jpg');
                $set_product->setSmallImage('/testimg/test.jpg');
                $set_product->setThumbnail('/testimg/test.jpg');
                $set_product->setCountryOfManufacture('AF');
                $set_product->setPrice(100.99) ;
                $set_product->setCost(88.33);
                $set_product->setSpecialPrice(99.85);
                $set_product->setSpecialFromDate('06/1/2021');
                $set_product->setSpecialToDate('06/1/2021');
                $set_product->setMsrpEnabled(1);
                $set_product->setMsrpDisplayActualPriceType(1);
                $set_product->setMsrp(99.99);
                $set_product->setMetaTitle('test meta title 2');
                $set_product->setMetaKeyword('test meta keyword 2');
                $set_product->setMetaDescription('test meta description 2');
                $set_product->setDescription('This is a long description');
                $set_product->setShortDescription('This is a short description');
                $set_product->setStockData(
                    [
                        'use_config_manage_stock' => 0,

                        'manage_stock' => 1,
                        'min_sale_qty' => 1,
                        'max_sale_qty' => 2,
                        'is_in_stock' => 1,
                        'qty' => 100
                    ]
                );

                $set_product->save();

                $get_product_id = $set_product->getId();
                echo "Upload simple product id :: ".$get_product_id."\n";

            }
            catch (\Exception $e) {
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
            AddNewColorAttribute::class
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