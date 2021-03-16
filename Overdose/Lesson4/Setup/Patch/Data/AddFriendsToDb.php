<?php

namespace Overdose\Lesson4\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;


/**
 * Class AddFriendsToDb
 * @package Overdose\Lesson4\Setup\Patch\Data
 */
class AddFriendsToDb implements DataPatchInterface, PatchRevertableInterface
{

    /**
     * friends list for use in patching
     * @apply
     */
    private const FRIENDS_LIST = [
        [ 'name'=>'Marj', 'age'=>'15', 'notes'=>'Alcohol'],[ 'name'=>'Kaitlynn', 'age'=>'24', 'notes'=>'Diphenhydramine HCl'],
        [ 'name'=>'Averell', 'age'=>'12', 'notes'=>'DEXTROMETHORPHAN HYDROBROMIDE, GUAIFENESIN'],
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
     * @var \Overdose\Lesson4\Model\FriendsFactory
     */
    private $model;

    /**
     * @var \Overdose\Lesson4\Model\ResourceModel\Friends
     */
    private $resourceModel;

    /**
     * AddFriendsToDb constructor.
     * @param \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup
     * @param \Overdose\Lesson4\Model\FriendsFactory $model
     * @param \Overdose\Lesson4\Model\ResourceModel\Friends $resourceModel
     */
    public function __construct(
        \Magento\Framework\Setup\ModuleDataSetupInterface $moduleDataSetup,
        \Overdose\Lesson4\Model\FriendsFactory $model,
        \Overdose\Lesson4\Model\ResourceModel\Friends $resourceModel
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

        foreach (self::FRIENDS_LIST as $items)
        {
            $model = $this->model->create();

            $model->setData('name',$items['name'])
                ->setData('age',$items['age'])
                ->setData('notes',$items['notes']);

            $this->resourceModel->save($model);
        }

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



