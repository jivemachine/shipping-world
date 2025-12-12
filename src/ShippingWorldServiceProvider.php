<?php

namespace jivemachine\ShippingWorld;

use jivemachine\ShippingWorld\Commands\InstallShippingWorldCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ShippingWorldServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('shipping-world')
            ->hasConfigFile()
            ->hasMigrations([
                'create_carrier_countries_table',
                'create_carrier_regions_table',
            ])
            ->hasCommands([
                InstallShippingWorldCommand::class,
            ]);
    }

    public function registeringPackage()
    {
        $this->app->singleton('shipping-world', function () {
            return new \jivemachine\ShippingWorld\ShippingWorld;
        });
    }
}
