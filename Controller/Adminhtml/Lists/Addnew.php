<?php
declare(strict_types=1);

/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */

namespace Recodem\Shopfinder\Controller\Adminhtml\Lists;

use Magento\Backend\App\Action;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class NewAction for creating a addnew page
 */
class Addnew extends Action
{
    /**
     * @return ResponseInterface|ResultInterface|void
     */
    public function execute()
    {
        $this->_forward('edit');
    }
}
