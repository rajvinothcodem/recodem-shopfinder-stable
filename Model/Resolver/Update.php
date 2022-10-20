<?php
declare(strict_types=1);
/**
 * @copyright   Copyright (c) 2022 ReRecodem Pvt Ltd (https://www.Recodem.com/)
 */
namespace Recodem\Shopfinder\Model\Resolver;

use Recodem\Shopfinder\Api\Data\ShopInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Recodem\Shopfinder\Api\ShopRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
/**
 * Class Update for updating the shop information from graphql API
 * @package ReRecodem\Shopfinder\Model\Resolver
 */
class Update implements ResolverInterface
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
     * @throws NoSuchEntityException
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $thanks_message = [];
        try {
            if ($context->getUserType() !== 2) {
                throw new GraphQlAuthorizationException(__('The current user isn\'t authorized.'));
            }
            $shopId = $args['input'][ShopInterface::SHOP_ID];
            $shopLists = $this->shopRepository->getById($shopId);
            if($shopLists->getShopId()) {
                if (isset($args['input'][ShopInterface::NAME])) {
                    $shopLists->setShopName($args['input'][ShopInterface::NAME]);
                }
                if (isset($args['input'][ShopInterface::IDENTIFIER])) {
                    $shopLists->setIdentifier($args['input'][ShopInterface::IDENTIFIER]);
                }
                if (isset($args['input'][ShopInterface::SHOP_IMAGE])) {
                    $shopLists->setShopImage(ShopInterface::SHOP_IMAGE);
                }
                if (isset($args['input'][ShopInterface::COUNTRY])) {
                    $shopLists->setCountry($args['input'][ShopInterface::COUNTRY]);
                }
                if (isset($args['input'][ShopInterface::LATITUDE])) {
                    $shopLists->setLatitude($args['input'][ShopInterface::LATITUDE]);
                }
                if (isset($args['input'][ShopInterface::LONGITUDE])) {
                    $shopLists->setLongitude($args['input'][ShopInterface::LONGITUDE]);
                }
                $this->shopRepository->save($shopLists);
            }else{
                throw new GraphQlNoSuchEntityException(__('The Shop doesn\'t exists for the given shop id'));
            }
        }catch (Exception $e) { }
        $thanks_message['success_message']=__("Shop was updated");
        return $thanks_message;
    }
}
