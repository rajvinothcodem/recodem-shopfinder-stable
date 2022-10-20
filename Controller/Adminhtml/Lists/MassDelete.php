<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Controller\Adminhtml\Lists;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use Recodem\Shopfinder\Model\ResourceModel\Lists\CollectionFactory;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;

/**
 * Class MassDelete for selecting grid items to delete in bulk
 */
class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * Massactions filter.
     *
     * @var Filter
     */
    protected $_filter;

    /**
     * @var CollectionFactory
     */
    protected $_collectionFactory;
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    /**
     * @param Context           $context
     * @param Filter            $filter
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        ShopRepositoryInterface $shopRepository
    )
    {
        $this->_filter = $filter;
        $this->_collectionFactory = $collectionFactory;
        $this->shopRepository = $shopRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        try {
            $collection = $this->_filter->getCollection($this->_collectionFactory->create());
            $collectionSize = $collection->getSize();
            foreach ($collection->getItems() as $item) {
                $shop = $this->shopRepository->delete($item->getShopId());
            }
            $this->messageManager->addSuccessMessage(
                __('A total of %1 shop(s) have been deleted.', $collectionSize)
            );
        }catch (\Exception $e) {
            $this->messageManager->addErrorMessage(
                __('Cannot delete the shop',$e->getMessage())
            );
        }
        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }


}
