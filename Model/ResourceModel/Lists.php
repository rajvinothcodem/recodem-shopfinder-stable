<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Lists resourcemodel class for creating and updating data
 */
class Lists extends AbstractDb
{
    /**
     * @var DateTime
     */
    protected $date;

    /**
     * Lists constructor.
     * @param Context $context
     * @param DateTime $date
     */
    public function __construct(
        Context $context,
        DateTime $date
    )
    {
        parent::__construct($context);
        $this->date = $date;
    }

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('shopfinder', 'shop_id');
    }

    /**
     * @param AbstractModel $object
     *
     * @return $this|AbstractDb
     */
    protected function _beforeSave(AbstractModel $object)
    {
        //set default Update At and Create At time post
        $object->setUpdatedAt($this->date->date());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->date->date());
        }

        return $this;
    }
}
