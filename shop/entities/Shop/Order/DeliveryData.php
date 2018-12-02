<?php

namespace shop\entities\Shop\Order;

class DeliveryData
{
    public $index;
    public $country;
    public $town;
    public $street;

    public function __construct($index, $country, $town, $street)
    {
        $this->index = $index;
        $this->country = $country;
        $this->town = $town;
        $this->street = $street;
    }
}