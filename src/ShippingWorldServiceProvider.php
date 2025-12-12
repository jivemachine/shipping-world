<?php

namespace jivemachine\ShippingWorld;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use jivemachine\ShippingWorld\Commands\InstallShippingWorldCommand;

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
            return new \jivemachine\ShippingWorld\ShippingWorld();
        });
    }
}
