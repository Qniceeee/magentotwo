<?php

namespace Overdose\ExtraLesson3\Setup\Patch\Schema;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\Patch\SchemaPatchInterface;
use Magento\Framework\Setup\Patch\PatchRegistry;
/**
 * Class AddFriendsToDb
 * @package Overdose\Lesson3\Setup\Patch\Data
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

            ->newTable($this->moduleDataSetup->getTable('overdose_extralesson3'))
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
                'text',
                \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                100,
                ['nullable' => false, 'default' => 'simple'],
                'some text'
            )
            ->setComment('Overdose lesson Table')
            ->setOption('type', 'InnoDB')
            ->setOption('charset', 'utf8');



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



