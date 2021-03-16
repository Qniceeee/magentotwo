<?php

namespace Overdose\Brands\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\SchemaPatchInterface;

/**
 * Class Scheming
 * @package Overdose\Brands\Setup\Patch\Schema
 */
class Scheming implements SchemaPatchInterface
{
    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * Scheming constructor.
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }


    /**
     * @return Scheming|void
     * @throws \Zend_Db_Exception
     */
    public function apply()
    {
        $table = $this->moduleDataSetup->getConnection()

            ->newTable($this->moduleDataSetup->getTable('catalog_product_entity_select'))
            ->addColumn(
                'value_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'value id'
            )
            ->addColumn(
                'attribute_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                5,
                ['nullable' => false, 'default' => '0', 'unsigned' => true,],
                'attribute id'
            )
            ->addColumn(
                'store_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                5,
                ['nullable' => false, 'default' => '0', 'unsigned' => true,],
                'store id'
            )
            ->addColumn(
                'entity_id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                10,
                ['nullable' => false, 'unsigned' => true, 'default' => '0'],
                'entity id'
            )
            ->addColumn(
                'value',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                255,
                ['nullable' => true,],
                'value'
            )
            ->setOption('type', 'InnoDB')
            ->setOption('charset', 'utf8')
            ->setComment('Overdose brands Table');



        $this->moduleDataSetup->getConnection()->createTable($table);
    }
    /**
     * {@inheritdoc}
     */
    public function revert()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @return array
     */
    public static function getDependencies()
    {
        return [];
    }
}



