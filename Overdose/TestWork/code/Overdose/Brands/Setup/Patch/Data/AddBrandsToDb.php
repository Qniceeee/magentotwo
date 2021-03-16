<?php

namespace Overdose\Brands\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;


class AddBrandsToDb implements DataPatchInterface, PatchRevertableInterface
{


    private const BRANDS_LIST = [
        [ 'brand_name'=>'Guci', 'brand_title'=>'guci'],
        [ 'brand_name'=>'Adidas', 'brand_title'=>'adidas'],
        [ 'brand_name'=>'Calvin Klein', 'brand_title'=>'calvin_klein'],
        [ 'brand_name'=>'Lacoste', 'brand_title'=>'lacoste'],
        [ 'brand_name'=>'Balenciaga', 'brand_title'=>'balenciaga'],

    ];

    private $moduleDataSetup;

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }


    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->moduleDataSetup->getConnection()->insertArray(
            'overdose_brands',
            ['brand_name', 'brand_title'],
            self::BRANDS_LIST);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public static function getDependencies()
    {
        return [];
    }

    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function getAliases()
    {
        return [];
    }
}



