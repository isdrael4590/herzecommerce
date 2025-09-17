<?php
namespace Database\Factories;

use Modules\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'sku' => $this->faker->unique()->numberBetween(1000000, 9999999),
            'name' => $this->generateProductName(),
            'image_path' => $this->generateImagePath(),
            'description' => $this->faker->paragraph(rand(3, 6)),
            'price' => $this->faker->randomFloat(2, 5, 200),
            'subcategory_id' => $this->faker->numberBetween(1, 20),
        ];
    }

    private function generateImagePath(): string
    {
        // Usar placeholders predefinidos
        $placeholders = [
            'products/placeholder-1.jpg',
            'products/placeholder-2.jpg',
            'products/placeholder-3.jpg',
            'products/placeholder-4.jpg',
            'products/placeholder-5.jpg',
            'products/product-sample-1.jpg',
            'products/product-sample-2.jpg',
            'products/product-sample-3.jpg',
            'products/no-image.jpg',
        ];

        return $this->faker->randomElement($placeholders);
    }

    private function generateProductName(): string
    {
        $productTypes = [
            'Smartphone', 'Laptop', 'Tablet', 'Auriculares', 'Cámara',
            'Monitor', 'Teclado', 'Mouse', 'Impresora', 'Disco Duro',
            'Smartwatch', 'Altavoces', 'Router', 'Webcam', 'SSD',
            'Proyector', 'Micrófono', 'Power Bank', 'Memoria USB', 'Cable HDMI'
        ];

        $brands = [
            'TechPro', 'Digital+', 'SmartTech', 'ProMax', 'UltraDevice',
            'NextGen', 'PowerTech', 'EliteDevice', 'MegaTech', 'SuperDevice',
            'TechMaster', 'ProDevice', 'SmartMax', 'UltraTech', 'PowerMax'
        ];

        $productType = $this->faker->randomElement($productTypes);
        $brand = $this->faker->randomElement($brands);
        $model = $this->faker->bothify('##??##');

        return $brand . ' ' . $productType . ' ' . $model;
    }

    // Método para generar imágenes reales (solo si tienes GD instalado)
    public function withRealImages(): static
    {
        return $this->state(function (array $attributes) {
            $imageDir = storage_path('app/public/products');
            
            // Crear directorio si no existe
            if (!is_dir($imageDir)) {
                mkdir($imageDir, 0755, true);
            }

            try {
                // Intentar generar imagen real
                $fullPath = $this->faker->image($imageDir, 400, 300, null, false);
                
                if ($fullPath && file_exists($fullPath)) {
                    return [
                        'image_path' => 'products/' . basename($fullPath),
                    ];
                }
            } catch (\Exception $e) {
                // Si falla, mantener placeholder
            }

            return [];
        });
    }

    // Método para productos de diferentes rangos de precio
    public function budget(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => $this->faker->randomFloat(2, 5, 50),
            ];
        });
    }

    public function premium(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'price' => $this->faker->randomFloat(2, 200, 1000),
            ];
        });
    }

    public function electronics(): static
    {
        return $this->state(function (array $attributes) {
            $electronicsNames = [
                'Samsung Galaxy S24', 'iPhone 15 Pro', 'MacBook Air M2',
                'Dell XPS 13', 'iPad Pro 12.9', 'Sony WH-1000XM5',
                'LG OLED 55C3', 'Canon EOS R6', 'Nintendo Switch OLED',
                'PlayStation 5', 'Xbox Series X', 'AirPods Pro 2'
            ];

            return [
                'name' => $this->faker->randomElement($electronicsNames) . ' ' . $this->faker->numberBetween(128, 1024) . 'GB',
                'subcategory_id' => $this->faker->numberBetween(1, 10), // Electrónicos
                'price' => $this->faker->randomFloat(2, 100, 2000),
            ];
        });
    }
}