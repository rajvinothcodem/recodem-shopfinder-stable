<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Controller\Adminhtml\Lists;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Recodem\Shopfinder\Model\ImageUploader;
use Magento\Backend\App\Action\Context;

/**
 * Class Shopimage for uploading shop image
 */
class Shopimage extends Action
{
    /**
     * @var ImageUploader
     */
    public $imageUploader;

    /**
     * Shopimage constructor.
     * @param Context $context
     * @param ImageUploader $imageUploader
     */

    public function __construct(
        Context $context,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        try {
            $imageUploadId = $this->getRequest()->getParam('param_name');
            $result = $this->imageUploader->saveFileToTmpDir($imageUploadId);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}
