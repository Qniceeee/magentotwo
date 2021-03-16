<?php
namespace Overdose\Brands\Model;


use Overdose\Brands\Api\Data\BrandInterface;

/**
 * Class Brands
 * @package Overdose\Brands\Model
 */
class Brands extends \Magento\Framework\Model\AbstractExtensibleModel implements BrandInterface
{

    /**
     * @return mixed|null
     */
    public function getId()
    {
        return $this->getData(self::FIELD_NAME_ID);
    }

    /**
     * @return mixed|null
     */
    public function getById()
    {
        return $this->getData(self::FIELD_NAME_ID);
    }


    /**
     * @return mixed|string|null
     */
    public function getBrandName()
    {
        return $this->getData(self::FIELD_NAME_BRAND_NAME);
    }

    /**
     * @param $brandName
     * @return \Magento\Framework\Model\AbstractExtensibleModel|\Magento\Framework\Model\AbstractModel|mixed|Brands
     */
    public function setBrandName($brandName)
    {
        return $this->setData($brandName, self::FIELD_NAME_BRAND_NAME);
    }

    /**
     * @return mixed|null
     */
    public function getBrandTitle()
    {
        return $this->getData(self::FIELD_NAME_BRAND_TITLE);
    }

    /**
     * @param $brandTitle
     * @return \Magento\Framework\Model\AbstractExtensibleModel|\Magento\Framework\Model\AbstractModel|mixed|Brands
     */
    public function setBrandTitle($brandTitle)
    {
        return $this->setData($brandTitle, self::FIELD_NAME_BRAND_TITLE);
    }

    /**
     * @return mixed|null
     */
    public function getCreatedAt()
    {
        return $this->getData(self::FIELD_NAME_CREATED_AT);
    }

    /**
     * @return mixed|null
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::FIELD_NAME_UPDATED_AT);
    }


    /**
     *path to the resource model?
     */
    protected function _construct()
    {
        $this->_init(\Overdose\Brands\Model\ResourceModel\Brands::class);
    }

}

