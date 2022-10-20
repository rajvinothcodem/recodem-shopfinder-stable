<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Model;

use Recodem\Shopfinder\Api\Data\ShopInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Lists to initialize the resource model objects
 * @package ReRecodem\Shopfinder\Model
 */
class Lists extends AbstractModel implements ShopInterface
{

    /**
     * Intialize Resource Model
     */
    protected function _construct()
    {
        $this->_init('Recodem\Shopfinder\Model\ResourceModel\Lists');
    }

    /**
     * Get ShopId.
     *
     * @return int
     */
    public function getShopId()
    {
        return $this->getData(self::SHOP_ID);
    }

    /**
     * Set ShopId.
     */
    public function setShopId($shopId)
    {
        return $this->setData(self::SHOP_ID, $shopId);
    }

    /**
     * Get Name.
     *
     * @return varchar
     */
    public function getShopName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set Name.
     */
    public function setShopName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get Identifier.
     *
     * @return varchar
     */
    public function getIdentifier()
    {
        return $this->getData(self::IDENTIFIER);
    }

    /**
     * Set Name.
     */
    public function setIdentifier($identifier)
    {
        return $this->setData(self::IDENTIFIER, $identifier);
    }

    /**
     * Get Image.
     *
     * @return varchar
     */
    public function getShopImage()
    {
        return $this->getData(self::SHOP_IMAGE);
    }

    /**
     * Set Image.
     */
    public function setShopImage($image)
    {
        return $this->setData(self::SHOP_IMAGE, $image);
    }

    /**
     * Get Country Code.
     *
     * @return varchar
     */
    public function getCountry()
    {
        return $this->getData(self::COUNTRY);
    }

    /**
     * Set Country Code.
     */
    public function setCountry($country)
    {
        return $this->setData(self::COUNTRY, $country);
    }

    /**
     * @return mixed|null
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * @param $latitude
     * @return Lists|mixed
     */
    public function setLatitude($latitude)
    {
        return $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * @return mixed|null
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * @param $longitude
     * @return Lists|mixed
     */
    public function setLongitude($longitude)
    {
        return $this->setData(self::LONGITUDE, $longitude);
    }

}
