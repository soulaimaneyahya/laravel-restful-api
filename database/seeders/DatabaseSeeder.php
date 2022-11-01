<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if ($this->command->confirm('Do you want to refresh the DB?')) {
            $this->command->call('migrate:fresh');
            $this->command->info('---------------------------------- database refreshed');
        }

        $this->call([
            UserSeeder::class, 
            CategorySeeder::class, 
            ProductSeeder::class,
            TransactionSeeder::class,
        ]);

        $this->command->info("---------------------------------- thanks seeder");
    }
}
