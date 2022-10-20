<?php
declare(strict_types=1);

/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Block\Adminhtml\Lists\Edit\Buttons;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;
/**
 * Class GenericButton for adding buttons to the form
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * @var PageRepositoryInterface
     */
    protected $pageRepository;
    /**
     * @param Context $context
     * @param  PageRepositoryInterface $pageRepository
     */
    public function __construct(
        Context $context,
        PageRepositoryInterface $pageRepository
    ) {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
    }
    /**
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
