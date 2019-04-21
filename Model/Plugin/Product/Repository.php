<?php

namespace Repin\SalesInformation\Model\Plugin\Product;


use Repin\SalesInformation\Api\SalesInformationRepositoryInterface;

class Repository
{

    protected $salesInformationRepository;

    public function __construct(
        SalesInformationRepositoryInterface $salesInformationRepository
    )
    {
        $this->salesInformationRepository = $salesInformationRepository;
    }

    public function afterGet
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $product
    )
    {
        $salesInformation = $this->salesInformationRepository->get($product->getId());

        $extensionAttributes = $product->getExtensionAttributes();

        $extensionAttributes->setSalesInformation($salesInformation);

        $product->setExtensionAttributes($extensionAttributes);

        return $product;

    }

}