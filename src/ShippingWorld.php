<?php

namespace jivemachine\ShippingWorld;

use jivemachine\ShippingWorld\Models\CarrierCountry;

class ShippingWorld
{
    public function countries()
    {
        return CarrierCountry::query()
            ->orderBy('name')
            ->get();
    }

    public function country(string $iso2): ?CarrierCountry
    {
        return CarrierCountry::where('iso_alpha2', strtoupper($iso2))->first();
    }
}
