<?php

namespace Repin\SalesInformation\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface SalesInformationInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getQty();


    /**
     * @param int $qty
     */
    public function setQty($qty);


    /**
     * Set Product Id for further updates
     *
     * @param int $id
     * @return self
     */
    public function setProductId($id);


    /**
     * Retrieve product id
     *
     * @return int
     */
    public function getProductId();


    /**
     * @return string
     */
    public function getLastOrder();


    /**
     * @param string $date
     */
    public function setLastOrder($date);


    /**
     * @return \Repin\SalesInformation\\Api\Data\SalesInformationExtensionInterface|null
     */
    public function getExtensionAttributes();


    /**
     * @param \Repin\SalesInformation\Api\Data\SalesInformationExtensionInterface $extensionAttributes
     * @return self
     */
    public function setExtensionAttributes(
        \Repin\SalesInformation\Api\Data\SalesInformationExtensionInterface $extensionAttributes
    );
}