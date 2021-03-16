<?php

namespace Overdose\Lesson4\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\Patch\PatchRegistry;
/**
 * Class AddFriendsToDb
 * @package Overdose\Lesson4\Setup\Patch\Data
 */
class Scheming implements SchemaPatchInterface
{
    private $moduleDataSetup;

    public static function getDependencies()
    {
        return [];
    }

    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }


    public function apply()
    {
        $table = $this->moduleDataSetup->getConnection()

            ->newTable($this->moduleDataSetup->getTable('overdose_lesson4'))
            ->addColumn(
                'id',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                'Contacts ID'
            )
            ->addColumn(
                'name',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => 'simple'],
                'Name'
            )
            ->addColumn(
                'notes',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => 'simple'],
                'some notes'
            )
            ->setComment('Overdose lesson Table')
            ->setOption('type', 'InnoDB')
            ->setOption('charset', 'utf8')
            ->addColumn(
                'age',
                \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                null,
                ['nullable' => false],
                'Age'
            );



        $this->moduleDataSetup->getConnection()->createTable($table);
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



