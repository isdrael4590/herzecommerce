<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;
use Modules\Product\Models\Subcategory;
use Modules\Product\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public Product $product;
    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;
    public $current_image_path;

    public $productData = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    protected function rules()
    {
        return [
            'productData.sku' => 'required|string|max:255|unique:products,sku,' . $this->product->id,
            'productData.name' => 'required|string|max:255',
            'productData.description' => 'required|string|min:10',
            'productData.price' => 'required|numeric|min:0.01',
            'productData.subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|max:2048',
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    protected $messages = [
        'productData.sku.required' => 'El código del producto es obligatorio.',
        'productData.sku.unique' => 'Este código ya existe.',
        'productData.name.required' => 'El nombre del producto es obligatorio.',
        'productData.description.required' => 'La descripción es obligatoria.',
        'productData.description.min' => 'La descripción debe tener al menos 10 caracteres.',
        'productData.price.required' => 'El precio es obligatorio.',
        'productData.price.numeric' => 'El precio debe ser un número.',
        'productData.price.min' => 'El precio debe ser mayor a 0.',
        'productData.subcategory_id.required' => 'Debe seleccionar una subcategoría.',
        'image.image' => 'El archivo debe ser una imagen.',
        'image.max' => 'La imagen no debe superar los 2MB.',
        'family_id.required' => 'Debe seleccionar una familia.',
        'category_id.required' => 'Debe seleccionar una categoría.',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->families = Family::orderBy('name')->get();
        
        // Cargar datos del producto
        $this->productData = [
            'sku' => $product->sku,
            'name' => $product->name,
            'description' => $product->description ?? '',
            'price' => $product->price,
            'subcategory_id' => $product->subcategory_id,
        ];

        // Guardar la ruta de la imagen actual
        $this->current_image_path = $product->image_path;

        // Cargar la jerarquía (familia -> categoría -> subcategoría)
        $subcategory = $product->subcategory;
        if ($subcategory) {
            $category = $subcategory->category;
            if ($category) {
                $this->category_id = $category->id;
                $family = $category->family;
                if ($family) {
                    $this->family_id = $family->id;
                }
            }
        }
    }

    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->productData['subcategory_id'] = '';
        $this->resetErrorBag(['category_id', 'productData.subcategory_id']);
    }

    public function updatedCategoryId($value)
    {
        $this->productData['subcategory_id'] = '';
        $this->resetErrorBag('productData.subcategory_id');
    }

    public function updatedImage()
    {
        $this->validate([
            'image' => 'image|max:2048',
        ]);
    }

    #[Computed()]
    public function categories()
    {
        if (!$this->family_id) {
            return collect();
        }
        return Category::where('family_id', $this->family_id)
                      ->orderBy('name')
                      ->get();
    }

    #[Computed()]
    public function subcategories()
    {
        if (!$this->category_id) {
            return collect();
        }
        return Subcategory::where('category_id', $this->category_id)
                         ->orderBy('name')
                         ->get();
    }

    public function update()
    {
        \Log::info('=== INICIO UPDATE ===');
        \Log::info('Datos recibidos para actualizar:', [
            'productData' => $this->productData,
            'family_id' => $this->family_id,
            'category_id' => $this->category_id,
            'has_new_image' => !is_null($this->image)
        ]);

        // Verificar que los campos no estén vacíos
        if (empty(trim($this->productData['sku']))) {
            $this->addError('productData.sku', 'El código SKU no puede estar vacío.');
            return;
        }

        if (empty(trim($this->productData['name']))) {
            $this->addError('productData.name', 'El nombre no puede estar vacío.');
            return;
        }

        if (empty($this->productData['price']) || $this->productData['price'] <= 0) {
            $this->addError('productData.price', 'El precio debe ser mayor a 0.');
            return;
        }

        // Validar todos los datos
        try {
            \Log::info('Iniciando validación...');
            $this->validate();
            \Log::info('Validación pasada correctamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Errores de validación:', $e->errors());
            throw $e;
        }

        try {
            \Log::info('Intentando actualizar producto...');
            
            // Actualizar el producto
            $this->product->update([
                'sku' => trim($this->productData['sku']),
                'name' => trim($this->productData['name']),
                'description' => trim($this->productData['description']) ?: null,
                'price' => floatval($this->productData['price']),
                'subcategory_id' => intval($this->productData['subcategory_id']),
            ]);

            \Log::info('Producto actualizado con ID:', ['id' => $this->product->id]);

            // Manejar nueva imagen si existe
            if ($this->image) {
                try {
                    \Log::info('Guardando nueva imagen...');
                    
                    // Eliminar imagen anterior si existe
                    if ($this->current_image_path) {
                        Storage::disk('public')->delete($this->current_image_path);
                        \Log::info('Imagen anterior eliminada:', ['path' => $this->current_image_path]);
                    }
                    
                    // Guardar nueva imagen
                    $imagePath = $this->image->store('products', 'public');
                    $this->product->update(['image_path' => $imagePath]);
                    $this->current_image_path = $imagePath;
                    
                    \Log::info('Nueva imagen guardada en:', ['path' => $imagePath]);
                } catch (\Exception $e) {
                    \Log::error('Error guardando imagen:', ['error' => $e->getMessage()]);
                    // No fallar por la imagen, continuar
                }
            }

            // Mensaje de éxito
            session()->flash('success', 'Producto actualizado exitosamente.');
            
            // Resetear solo la nueva imagen
            $this->image = null;
            
            \Log::info('=== PRODUCTO ACTUALIZADO EXITOSAMENTE ===');
            
            // Opcional: Redirigir a la lista de productos
            // return redirect()->route('admin.products.index');
            
        } catch (\Exception $e) {
            \Log::error('=== ERROR ACTUALIZANDO PRODUCTO ===');
            \Log::error('Error actualizando producto:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            session()->flash('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    public function removeImage()
    {
        $this->image = null;
        $this->resetErrorBag('image');
    }

    public function deleteCurrentImage()
    {
        try {
            if ($this->current_image_path) {
                // Eliminar del storage
                Storage::disk('public')->delete($this->current_image_path);
                
                // Actualizar el producto
                $this->product->update(['image_path' => null]);
                $this->current_image_path = null;
                
                session()->flash('success', 'Imagen eliminada exitosamente.');
            }
        } catch (\Exception $e) {
            \Log::error('Error eliminando imagen:', ['error' => $e->getMessage()]);
            session()->flash('error', 'Error al eliminar la imagen.');
        }
    }

    public function cancel()
    {
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    public function render()
    {
        return view('livewire.admin.products.product-edit');
    }
}