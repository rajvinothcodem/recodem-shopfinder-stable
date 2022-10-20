<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Controller\Adminhtml\Lists;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;
use Recodem\Shopfinder\Model\ListsFactory;
use Recodem\Shopfinder\Model\ImageUploader;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem;
use Magento\Ui\Component\MassAction\Filter;
use Magento\Backend\App\Action;

/**
 * Class Save for submiting the form data
 */
class Save extends Action
{

    /**
     * @var AdapterFactory
     */
    protected $adapterFactory;

    /**
     * @var UploaderFactory
     */
    protected $uploader;

    /**
     * @var Filesystem
     */
    protected $filesystem;
    /**
     * @var ListsFactory
     */
    protected $listFactory;
    /**
     * @var ShopRepositoryInterface
     */
    protected $shoprepository;
    /**
     * @var ImageUploader
     */
    protected $imageUploader;
    /**
     * @param Context $context
     * @param AdapterFactory $adapterFactory
     * @param UploaderFactory $uploader
     * @param Filesystem $filesystem
     * @param ListsFactory $listsFactory
     * @param ShopRepositoryInterface  $shoprepository
     * @param ImageUploader $imageUploader
     */

    public function __construct(
        Context $context,
        AdapterFactory $adapterFactory,
        UploaderFactory $uploader,
        Filesystem $filesystem,
        ListsFactory $listsFactory,
        ShopRepositoryInterface  $shoprepository,
        ImageUploader $imageUploader
    )
    {
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
        $this->listsFactory = $listsFactory;
        $this->shoprepository = $shoprepository;
        $this->imageUploader = $imageUploader;
        parent::__construct($context);
    }

    /**
     * Create or update the shop data
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('shopfinder/lists/addnew');
            return;
        }
        try {
            $rowData = $this->listsFactory->create();
            $data = $this->addimagepath($data);
            $rowData->setData($data['lists']);
            $this->shoprepository->save($rowData);

            $this->messageManager->addSuccessMessage(__('Shop has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        $this->_redirect('shopfinder/lists/index');
    }

    /**
     * Get uploaded image and and move to base image path, add set shop image
     */

    public function addimagepath($datalist)
    {
        $data = $datalist['lists'];
        if (isset($data['shop_image'][0]['name']) && isset($data['shop_image'][0]['tmp_name'])) {
            $shopimageName = $data['shop_image'][0]['name'];
            unset($data['shop_image']);
            $data['shop_image']= $this->imageUploader->moveFileFromTmp($shopimageName);
        } elseif (isset($data['shop_image'][0]['name']) && !isset($data['shop_image'][0]['tmp_name'])) {
            $shopimageName = $data['shop_image'][0]['name'];
            unset($data['shop_image']);
            $data['shop_image']= $shopimageName;
        } else {
            $data['shop_image'] = '';
        }
        $finalData['lists'] = $data;
        return $finalData;
    }


}
