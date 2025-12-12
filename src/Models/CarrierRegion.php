<?php

namespace jivemachine\ShippingWorld\Models;

use Illuminate\Database\Eloquent\Model;

class CarrierRegion extends Model
{
    protected $fillable = [
        'carrier_country_id',
        'world_state_id',
        'iso_subdivision_code',
        'code',
        'name',
        'is_active',
    ];

    public function country()
    {
        return $this->belongsTo(CarrierCountry::class, 'carrier_country_id');
    }
}
