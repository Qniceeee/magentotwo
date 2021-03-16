<?php
namespace Overdose\Brands\Api\Data;

interface BrandInterface


{
    const TABLE_NAME = 'overdose_brands';
    const FIELD_NAME_ID = 'id';
    const FIELD_NAME_BRAND_NAME = 'brand_name';
    const FIELD_NAME_BRAND_TITLE = 'brand_title';
    const FIELD_NAME_CREATED_AT = 'created_at';
    const FIELD_NAME_UPDATED_AT = 'updated_at';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @return string
     */
    public function getBrandName();

    /**
     * @param $brandName
     * @return mixed
     */
    public function setBrandName($brandName);

    /**
     * @return mixed
     */
    public function getBrandTitle();

    /**
     * @param $brandTitle
     * @return mixed
     */
    public function setBrandTitle($brandTitle);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @return mixed
     */
    public function getUpdatedAt();


}

