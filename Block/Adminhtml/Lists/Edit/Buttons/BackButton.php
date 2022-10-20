<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Block\Adminhtml\Lists\Edit\Buttons;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class BackButton for adding back button in admin shop list form
 */
class BackButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
