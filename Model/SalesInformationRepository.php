<?php

namespace Repin\SalesInformation\Model;


use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Sales\Api\OrderItemRepositoryInterface;
use Magento\Sales\Api\OrderRepositoryInterface;
use Repin\SalesInformation\Api\SalesInformationRepositoryInterface;
use \Repin\SalesInformation\Api\Data\SalesInformationInterfaceFactory;
use Repin\SalesInformation\Api\Data\SalesInformationInterface;
use \Magento\Catalog\Api\ProductRepositoryInterface;
use \Magento\Sales\Model\ResourceModel\Order\CollectionFactory;


class SalesInformationRepository implements SalesInformationRepositoryInterface
{

    public $orderStatus;
    protected $salesInformationInterfaceFactory;
    protected $orderCollectionFactory;
    protected $productRepository;

    public function __construct(
        SalesInformationInterfaceFactory $salesInformationInterfaceFactory,
        ProductRepositoryInterface $productRepository,
        OrderItemRepositoryInterface $orderItemRepository,
        OrderRepositoryInterface $orderRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionFactory $orderCollectionFactory,
        $orderStatus = 'processing'
    )
    {
        $this->orderStatus = $orderStatus;
        $this->orderItemRepository = $orderItemRepository;
        $this->orderCollectionFactory = $orderCollectionFactory;
        $this->productRepository = $productRepository;
        $this->salesInformationInterfaceFactory = $salesInformationInterfaceFactory;
    }

    public function get($productId): SalesInformationInterface
    {
        $dataObject = $this->salesInformationInterfaceFactory->create();

        $lastOrderDate = '';
        $itemQty = 0;

        $orders = $this->orderCollectionFactory->create()
            ->addFieldToSelect(
                '*'
            )->addFieldToFilter(
                'status', $this->orderStatus

            )->setOrder(
                'created_at',
                'desc'
            );
        $orders->getSelect()->join(
            ['order_items' => $orders->getTable('sales_order_item')],
            'main_table.entity_id = order_items.order_id',
            ['qty_ordered']
        );
        $orders->getSelect()->where('order_items.product_id=?', $productId);


        if ($orders->getSize()) {

            foreach ($orders->getItems() as $item) {
                $itemQty += $item->getData('qty_ordered');
            }

            $lastOrderDate = $orders->getFirstItem()->getData('created_at');
        }

        $dataObject->setQty($itemQty);
        $dataObject->setLastOrder($lastOrderDate);

        return $dataObject;
    }
}