<?php

namespace Repin\SalesInformation\Api;


use Repin\SalesInformation\Api\Data\SalesInformationInterface;

interface SalesInformationRepositoryInterface
{

    public function get($productId) : SalesInformationInterface;
}