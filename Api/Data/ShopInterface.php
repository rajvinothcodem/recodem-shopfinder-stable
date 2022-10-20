<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Api\Data;

/**
 * class ShopInterface for getting the shop list field data
 */
interface ShopInterface
{
    /**
     * Constants for keys of data array.
     */
    const SHOP_ID = 'shop_id';
    const NAME = 'shop_name';
    const IDENTIFIER = 'identifier';
    const SHOP_IMAGE = 'shop_image';
    const IS_ACTIVE = 'is_active';
    const MODIFIED_AT = 'modified_at';
    const CREATED_AT = 'created_at';
    const COUNTRY = 'country';
    const LATITUDE = 'latitude';
    const LONGITUDE = 'longitude';
    const BASE_IMG_TMP_PATH = 'shopimage/tmp/image';
    const BASE_IMG_PATH = 'shopimage/image';
    const ALLOWED_IMG_EXTENSIONS = ['jpg', 'jpeg', 'gif', 'png'];

    /**
     * Get ShopId.
     *
     * @return int
     */
    public function getShopId();

    /**
     * Set ShopId.
     * @param $shopId int
     * @return $this
     */
    public function setShopId($shopId);

    /**
     * Get Name.
     *
     * @return string
     */
    public function getShopName();

    /**
     * Set Name.
     * @param $name string
     * @return $this
     */
    public function setShopName($name);

    /**
     * Get Identifier.
     *
     * @return string
     */
    public function getIdentifier();

    /**
     * Set Identifier.
     * @param $identifier string
     * @return $this
     */
    public function setIdentifier($identifier);

    /**
     * Get Image.
     *
     * @return string|null
     */
    public function getShopImage();

    /**
     * Set Image.
     * @param $image string
     * @return $this
     */
    public function setShopImage($image);

    /**
     * Get Country Code.
     *
     * @return string
     */
    public function getCountry();

    /**
     * Set Image.
     * @param $country string
     * @return $this
     */
    public function setCountry($country);

    /**
     * @return mixed
     */
    public function getLatitude();

    /**
     * @param $latitude
     * @return mixed
     */
    public function setLatitude($latitude);

    /**
     * @return mixed
     */
    public function getLongitude();

    /**
     * @param $latitude
     * @return mixed
     */
    public function setLongitude($longitude);

}
