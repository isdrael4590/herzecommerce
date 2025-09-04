<?php

namespace Modules\Product\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Product\Models\Family;
use Modules\Product\Models\Category;
use Modules\Product\Models\Subcategory;

class FamilySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $families = [
            'Tecnología' => [
                'Televisores' => [
                    'Accesorios para TV',
                    'LED',
                    'OLED',
                    'Otros',
                    'Proyectores',
                    'Insumos para TV',
                    'Televisores LGS'
                ],
                'Celulares' => [
                    'Accesorios',
                    'Audifonos',
                    'Baterías externas',
                    'Carcasas y láminas',
                    'Celulares y Smartphones',
                    'Reacondicionados',
                    'Smartwatch',
                    'Tarjeta de memoria',
                    'Telefonía inalámbricos',
                ],
                // ... (rest of your data structure remains the same)
                'Computación' => [
                    'Accesorios',
                    'Almacenamiento',
                    'Computadores de escritorio',
                    'Impresoras y Scanners',
                    'Laptops',
                    'Monitores',
                    'Otros',
                    'Software',
                    'Tablets',
                    'Todo computación',
                    'Camara web',
                    'Mouse y teclados',
                    'Audio y parlantes',
                    'Router y redes',
                ],
                // Add other categories as needed...
            ],
            // Add other families as needed...
        ];

        foreach ($families as $familyName => $categories) {
            // Create the family
            $family = Family::create(['name' => $familyName]);
            
            // Create categories for this family
            foreach ($categories as $categoryName => $subcategories) {
                $category = Category::create([
                    'name' => $categoryName,
                    'family_id' => $family->id
                ]);
                
                // Create subcategories for this category
                foreach ($subcategories as $subcategoryName) {
                    Subcategory::create([
                        'name' => $subcategoryName,
                        'category_id' => $category->id
                    ]);
                }
            }
        }
    }
}