<?php

namespace Overdose\Brands\Setup\Patch\Data;


use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Catalog\Model\Product;

/**
 * Class add customer example attribute to customer
 */
class AddBrandAttribute implements DataPatchInterface
{

    /**
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * AddBrandAttribute constructor.
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory)
    {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }


    /**
     * @return AddBrandAttribute|void
     */
    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $eavSetup = $this->eavSetupFactory->create();

        $eavSetup->addAttribute(Product::ENTITY, 'overdose_product_brands', [

            'group' => 'General',
            'type' => 'select',
            'label' => 'Overdose product Brand',
            'input' => 'select',
            'filterable' => true,
            'source'=> \Overdose\Brands\Model\Attribute\Source\BrandsAttributeSource::class,
            'required' => false,
            'sort_order' => 1,
            'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'used_in_product_listing' => true,
            'is_visible_on_front'=> true,
            'is_html_allowed_on_front'=> true,
            'used_for_sort_by'=> false,
            'is_used_for_promo_rules'=> true,
            'is_user_defined' => true,
            'is_comparable' => false,
            'is_filterable_in_search' => false,
 /*
            'backend' => '',
            'visible' => true,
            'required' => false,
            'searchable' => false,
            'filterable' => true,
            'user_defined'=>true,

            'system' => 1,
            'sort_order' => 1,
            'global' => 1,
            'is_used_in_grid' => false,
            'is_visible_in_grid' => false,
            'is_filterable_in_grid' => false,
            'used_in_product_listing' => false,
            'is_html_allowed_on_front' => true,
            'visible_on_front' => true,

            */



        ]);
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @return array
     */
    public function getAliases()
    {
        return [];
    }
}