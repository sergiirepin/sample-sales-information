<?php

namespace Repin\SalesInformation\Model;

use Magento\Framework\Api\AbstractExtensibleObject;
use Repin\SalesInformation\Api\Data\SalesInformationInterface;

class SalesInformation extends AbstractExtensibleObject implements SalesInformationInterface
{
    public function getLastOrder()
    {
        // TODO: Implement getLastOrder() method.
    }

    public function getQty()
    {
        // TODO: Implement getQty() method.
    }

    public function setLastOrder($date)
    {
        // TODO: Implement setLastOrder() method.
    }

    public function setQty($qty)
    {
        // TODO: Implement setQty() method.
    }

    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(
        \Repin\SalesInformation\Api\Data\SalesInformationExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

    public function setProductId($id)
    {
        // TODO: Implement setProductId() method.
    }

    public function getProductId()
    {
        // TODO: Implement getProductId() method.
    }
}