<?php

namespace jivemachine\ShippingWorld\Models;

use Illuminate\Database\Eloquent\Model;

class CarrierCountry extends Model
{
    protected $fillable = [
        'world_country_id',
        'iso_alpha2',
        'iso_alpha3',
        'name',
        'is_shipping_supported',
        'supports_ups',
        'supports_usps',
        'supports_fedex',
        'ups_code',
        'usps_code',
        'fedex_code',
        'requires_postcode',
        'requires_region',
        'region_label',
    ];

    public function regions()
    {
        return $this->hasMany(CarrierRegion::class);
    }
}
