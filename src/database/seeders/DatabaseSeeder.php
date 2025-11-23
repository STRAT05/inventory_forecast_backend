<?php

namespace Database\Seeders;

//use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    use WithoutModelEvents;
    public function run(): void
    {
        // \App\Models\User::factory(10)->create(); // <-- ADD // HERE

        // This is the line you wanted to run
        //Product::factory(100)->create(); // Create 100 products
        $this->call([
            ProductSeeder::class,
            //TaskSeeder::class,
        ]);
    }
}