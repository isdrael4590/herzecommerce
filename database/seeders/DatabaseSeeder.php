<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Modules\Product\database\seeders\ProductDatabaseSeeder;
use Modules\Product\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');


        $this->call([
            SuperUserSeeder::class,
            ProductDatabaseSeeder::class
        ]);

        Product::factory(50)->create();
    }
}
