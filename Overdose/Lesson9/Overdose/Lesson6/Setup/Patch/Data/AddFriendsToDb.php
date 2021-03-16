<?php

namespace Overdose\Lesson6\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;


/**
 * Class AddFriendsToDb
 * @package Overdose\Lesson6\Setup\Patch\Data
 */
class AddFriendsToDb implements DataPatchInterface, PatchRevertableInterface
{

    /**
     * friends list for use in patching
     * @apply
     */
    private const FRIENDS_LIST = [
        [ 'name'=>'Marj', 'age'=>'15', 'notes'=>'Alcohol'],[ 'name'=>'Kaitlynn', 'age'=>'24', 'notes'=>'Diphenhydramine HCl'],
        [ 'name'=>'Averell', 'age'=>'111', 'notes'=>'DEXTROMETHORPHAN HYDROBROMIDE, GUAIFENESIN'],
        [ 'name'=>'Jefferson', 'age'=>'17', 'notes'=>'Abrotanum, Aesculus hipp., Allium sativum, Arsenicum alb., Artemisia, Baptisia,'],
        [ 'name'=>'Alica', 'age'=>'23', 'notes'=>'ALCOHOL'],[ 'name'=>'Brynn', 'age'=>'24', 'notes'=>'betamethasone dipropionate'],
        [ 'name'=>'Gilligan', 'age'=>'65', 'notes'=>'Molds - Alternaria/Hormodendrum Mix'],
        [ 'name'=>'Kerk', 'age'=>'16', 'notes'=>'TITANIUM DIOXIDE, OCTINOXATE, OCTISALATE'],
        [ 'name'=>'Emilie', 'age'=>'22', 'notes'=>'potato'],[ 'name'=>'Kevan', 'age'=>'27', 'notes'=>'pioglitazone'],
    ];


    /**
     * @var \Magento\Framework\Setup\ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var \Overdose\Lesson6\Model\FriendsFactory
     */
    private $model;

    /**
     * @var \Overdose\Lesson6\Model\ResourceModel\Friends
     */
    private $resourceModel;

    /**
     * AddFriendsToDb constructor.
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Overdose\Lesson6\Model\FriendsFactory $model
     * @param \Overdose\Lesson6\Model\ResourceModel\Friends $resourceModel
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Overdose\Lesson6\Model\FriendsFactory $model,
        \Overdose\Lesson6\Model\ResourceModel\Friends $resourceModel
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->model = $model;
        $this->resourceModel = $resourceModel;
    }

    /**
     * {@inheritdoc}
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $this->moduleDataSetup->getConnection()->insertArray(
            'overdose_lesson6',
            ['name', 'age', 'notes'],
            self::FRIENDS_LIST);

        $this->moduleDataSetup->getConnection()->endSetup();
    }
    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [];
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
}



