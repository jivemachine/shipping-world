<?php

namespace jivemachine\ShippingWorld\Commands;

use Illuminate\Console\Command;
use jivemachine\ShippingWorld\Database\Seeders\ShippingWorldSeeder;

class InstallShippingWorldCommand extends Command
{
    protected $signature = 'shipping-world:install';
    protected $description = 'Install and seed carrier-ready data using nnjeim/world';

    public function handle(): int
    {
        // Basic sanity check
        if (! class_exists(\Nnjeim\World\Models\Country::class)) {
            $this->error('nnjeim/world is not installed or configured.');
            $this->line('Please install and run its migrations & seeders first.');
            return self::FAILURE;
        }

        $this->info('Running migrations for shipping-world...');
        $this->call('migrate');

        $this->info('Seeding carrier countries and regions...');
        $this->call('db:seed', [
            '--class' => ShippingWorldSeeder::class,
        ]);

        $this->info('shipping-world installed successfully ✅');

        return self::SUCCESS;
    }
}
