<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Model\Resolver;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
/**
 * Class Delete for deleting the shop list by shop id in Graphql Api
 * @package ReRecodem\Shopfinder\Model\Resolver
 */
class Delete implements ResolverInterface
{
    /**
     * @var ShopRepositoryInterface
     */
    protected $shopRepository;

    /**
     * Update constructor.
     * @param ShopRepositoryInterface $shopRepository
     */
    public function __construct(
        ShopRepositoryInterface $shopRepository
    ) {
        $this->shopRepository = $shopRepository;
    }

    /**
     * @param Field $field
     * @param ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array|\Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     * @throws GraphQlInputException
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        try {
            if($context->getUserType() !== 2) {
                throw new GraphQlAuthorizationException(__('The current user isn\'t authorized.'));
            }
            $shopId = $args['input']['shop_id'];
            $shopLists = $this->shopRepository->getById($shopId);
            if($shopLists->getShopId())
            {
                $shopname = $shopLists->getShopName();
                throw new GraphQlInputException(__("The shop {$shopname} cannot be deleted")) ;
            }else{
                throw new GraphQlNoSuchEntityException(__('The Shop doesn\'t exists for the given shop id'));
            }
        }catch (Exception $e) { }

    }
}
