<?php

namespace jivemachine\ShippingWorld\Facades;

use Illuminate\Support\Facades\Facade;

class ShippingWorld extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'shipping-world';
    }
}
