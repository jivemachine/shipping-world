<?php

namespace jivemachine\ShippingWorld\Database\Seeders;

use Illuminate\Database\Seeder;
use Nnjeim\World\Models\Country;
use Nnjeim\World\Models\State;
use jivemachine\ShippingWorld\Models\CarrierCountry;
use jivemachine\ShippingWorld\Models\CarrierRegion;

class ShippingWorldSeeder extends Seeder
{
    public function run(): void
    {
        // Seed countries
        Country::query()->chunk(100, function ($countries) {
            foreach ($countries as $country) {
                /** @var \Nnjeim\World\Models\Country $country */
                $carrierCountry = CarrierCountry::updateOrCreate(
                    ['world_country_id' => $country->id],
                    [
                        'iso_alpha2' => $country->iso2,
                        'iso_alpha3' => $country->iso3,
                        'name'       => $country->name,

                        // v0.1: naive defaults, refine later
                        'is_shipping_supported' => true,
                        'supports_ups'          => true,
                        'supports_usps'         => true,
                        'supports_fedex'        => true,
                        'requires_postcode'     => true,
                        'requires_region'       => in_array($country->iso2, ['US', 'CA', 'AU']),
                        'region_label'          => $this->regionLabelForCountry($country->iso2),
                    ]
                );

                // Seed regions for just a couple of countries at first (US / CA)
                if (in_array($country->iso2, ['US', 'CA'])) {
                    $states = State::query()
                        ->where('country_id', $country->id)
                        ->get();

                    foreach ($states as $state) {
                        CarrierRegion::updateOrCreate(
                            [
                                'carrier_country_id' => $carrierCountry->id,
                                'world_state_id'     => $state->id,
                            ],
                            [
                                'iso_subdivision_code' => $state->iso2 ?? null, // adjust if different
                                'code'                 => $state->iso2 ?? null,
                                'name'                 => $state->name,
                                'is_active'            => true,
                            ]
                        );
                    }
                }
            }
        });
    }

    protected function regionLabelForCountry(string $iso2): string
    {
        return match ($iso2) {
            'US' => 'State',
            'CA' => 'Province',
            'GB' => 'County',
            'AU' => 'State / Territory',
            default => 'State / Province',
        };
    }
}
