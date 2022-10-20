<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Model\Lists;

use Recodem\Shopfinder\Model\ResourceModel\Lists\CollectionFactory;
use Recodem\Shopfinder\Model\Lists;
use Recodem\Shopfinder\Ui\Component\Listing\Column\Image;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\UrlInterface;
/**
 * Class DataProvider to provide resource collection data to the form fields
 * @package ReRecodem\Shopfinder\Model\Lists
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $shopCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $shopCollectionFactory,
        array $meta = [],
        array $data = [],
        StoreManagerInterface $storeManager
    ) {
        $this->collection = $shopCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->_storeManager = $storeManager;
    }

    /**
     * @return array
     */
    public function getData()
    {

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Lists $lists */
        foreach ($items as $lists) {
            $this->loadedData[$lists->getShopId()]['lists'] = $lists->getData();
            if ($lists->getShopImage()) {
                $m[0]['name'] = $lists->getShopImage();
                $m[0]['url'] = $this->getMediaUrl().$lists->getShopImage();
                $this->loadedData[$lists->getShopId()]['lists']['shop_image'] = $m;
            }
        }

        return $this->loadedData;

    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl()
    {
        $mediaUrl = $this->_storeManager->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA).Image::IMAGE_PATH;
        return $mediaUrl;
    }
}
