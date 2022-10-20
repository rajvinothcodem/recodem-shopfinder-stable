<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Api;

use Recodem\Shopfinder\Api\Data\ShopInterface;
use Magento\Framework\Exception\CouldNotSaveException;
/**
 * class ShopRepositoryInterface for update/delete and save shop lists fields
 */
interface ShopRepositoryInterface
{
    /**
     * Create or update shop
     * @param ShopInterface $data
     * @return ShopInterface
     * @throws CouldNotSaveException
     */
    public function save(ShopInterface $data);

    /**
     * Get info about shop by shop id
     *
     * @param int $shopId
     * @return ShopInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($shopId);

    /**
     * Delete shop
     *
     * @param int $shopId
     * @return bool Will returned True if deleted
     * @throws \Magento\Framework\Exception\StateException
     */

    public function delete($shopId);


}
