<?php
declare(strict_types=1);

/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Model\ResourceModel\Lists;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
/**
 * Class Collection get resource model collection
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'shop_id';
    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'Recodem_shopfinder_lists_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'lists_collection';
    /**
     * Defining resource model.
     */
    protected function _construct()
    {
        $this->_init('Recodem\Shopfinder\Model\Lists','Recodem\Shopfinder\Model\ResourceModel\Lists');
    }
}
