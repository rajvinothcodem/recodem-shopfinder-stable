<?php
declare(strict_types=1);

/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Model;

use Recodem\Shopfinder\Model\ListsFactory;
use Recodem\Shopfinder\Model\ResourceModel\Lists;
use Recodem\Shopfinder\Model\Lists as ListsModel;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;
use Recodem\Shopfinder\Api\Data\ShopInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;
/**
 * class ShopRepositoryModel for update,delete and save form data
 */
class ShopRepositoryModel implements ShopRepositoryInterface
{
    /**
     * @var ListsFactory
     */
    protected  $listsfactory;
    /**
     * @var Lists
     */
    protected $listsResourceModelFactory;
    /**
     * @var ListsModel
     */
    protected $listsModel;

    /**
     * @param ListsFactory $listsfactory
     * @param Lists $listsResourceModelFactory
     * @param ListsModel $listsModel
     */
    public function __construct(
        ListsFactory $listsfactory,
        Lists $listsResourceModelFactory,
        ListsModel $listsModel
    )
    {
        $this->listsfactory = $listsfactory;
        $this->listsResourceModelFactory = $listsResourceModelFactory;
        $this->listsModel = $listsModel;
    }

    /**
     * create or update the shop
     * @param ShopInterface $data
     * @return ShopInterface
     * @throws CouldNotSaveException
     */

    public function save(ShopInterface $data)
    {
        try {
            $this->listsResourceModelFactory->save($data);
        } catch (\Exception $e) {
            throw new CouldNotSaveException(
                __('The Shop could not be saved'),
                $e->getMessage()
            );
        }
    }
    /**
     * Get info about shop by shop id
     * @param int $shopId
     * @return ShopInterface
     * @throws NoSuchEntityException
     */
    public function getById($shopId)
    {
        $listObject = $this->listsfactory->create();
        if($shopId) {
            try {
                $this->listsResourceModelFactory->load($listObject, $shopId, ShopInterface::SHOP_ID);
            } catch (\Exception $e) {
                throw new NoSuchEntityException(
                    __("The Shop that was requested doesn't exist. Verify and try again."), $e->getMessage()
                );
            }
        }
        return $listObject;
    }

    /**
     * Delete shop
     *
     * @param int $shopId
     * @return bool Will returned True if deleted
     * @throws StateException
     */
    public function delete($shopId)
    {
        if($shopId) {
            try {
                $listObject = $this->getById($shopId);
                $deleted = $this->listsResourceModelFactory->delete($listObject);
                return $deleted;
            } catch (\Exception $e) {
                throw new StateException(
                    __('The shop couldn\'t be removed.'),
                    $e->getMessage()
                );

            }
        }
    }


}
