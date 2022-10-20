<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Controller\Adminhtml\Lists;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Recodem\Shopfinder\Model\ListsFactory;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;
/**
 * Class Edit
 */
class Edit extends Action
{

    /**
     * Page factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var ListsFactory
     */
    protected $listsFactory;
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    /**
     * Edit constructor.
     *
     * @param PageFactory $resultPageFactory
     * @param ListsFactory $listsFactory
     * @param Context $context
     */
    public function __construct(
        PageFactory $resultPageFactory,
        ListsFactory $listsFactory,
        ShopRepositoryInterface $shopRepository,
        Context $context
    ) {

        $this->resultPageFactory = $resultPageFactory;
        $this->listsFactory = $listsFactory;
        $this->shopRepository = $shopRepository;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $shopid = $this->getRequest()->getParam('id');
        if ($shopid) {
            $lists = $this->shopRepository->getById($shopid);
            if (!$lists->getShopId()) {
                $this->messageManager->addErrorMessage(__('Shop no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath(
                    'shopfinder/lists/index'
                );

                return $resultRedirect;
            }
        }
        else{
            $lists = $this->listsFactory->create();
        }
        /** @var \Magento\Backend\Model\View\Result\Page|Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Recodem_Shopfinder::shopfinder');
        $resultPage->getConfig()->getTitle()
            ->set(__('Shops'))
            ->prepend($lists->getShopId() ? $lists->getShopName() : __('New Shop'));

        return $resultPage;
    }
}
