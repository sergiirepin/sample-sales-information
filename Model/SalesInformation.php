<?php

namespace Repin\SalesInformation\Model;

use Magento\Framework\Api\AbstractExtensibleObject;
use Repin\SalesInformation\Api\Data\SalesInformationInterface;

class SalesInformation extends AbstractExtensibleObject implements SalesInformationInterface
{

    protected $lastOrder;

    protected $qty;

    public function getLastOrder()
    {
        return $this->_get('last_order');

    }

    public function getQty()
    {
        return $this->_get('qty');
    }

    public function setLastOrder($date)
    {
        $this->setData('last_order', $date);
    }

    public function setQty($qty)
    {
        $this->setData('qty', $qty);
    }

    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    public function setExtensionAttributes(
        \Repin\SalesInformation\Api\Data\SalesInformationExtensionInterface $extensionAttributes
    )
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}