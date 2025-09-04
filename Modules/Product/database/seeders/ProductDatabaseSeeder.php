<?php

namespace Modules\Product\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Product\database\seeders\FamilySeeder;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            FamilySeeder::class
        ]);
    }
}
