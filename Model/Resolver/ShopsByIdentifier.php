<?php

declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Recodem\Shopfinder\Model\ResourceModel\Lists\CollectionFactory as ShopCollectionFactory;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
/**
 * Class ShopsByIdentifier for getting only particular shop using shop identifier
 * @package ReRecodem\Shopfinder\Model\Resolver
 */
class ShopsByIdentifier implements ResolverInterface

{
    /**
     * @var ShopCollectionFactory
     */
    protected $shopCollection;

    /**
     * ShopsByIdentifier constructor.
     * @param ShopCollectionFactory $shopCollection
     */
    public function __construct(
        ShopCollectionFactory $shopCollection
    ) {
        $this->shopCollection = $shopCollection;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed|null
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
                if ($context->getUserType() !== 2) {
                    throw new GraphQlAuthorizationException(__('The current user isn\'t authorized.'));
                }
                $collection = $this->shopCollection->create()
                                ->addFieldToFilter('identifier',['eq'=>[$args['identifier']]])
                                ->getFirstItem();
                $shopfinderlist =  $collection->getData();
            } catch (NoSuchEntityException $e) {
                throw new GraphQlNoSuchEntityException(__($e->getMessage()), $e);
            }
        return $shopfinderlist;
    }
}
