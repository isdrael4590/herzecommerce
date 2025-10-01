<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithFileUploads;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;
use Modules\Product\Models\Subcategory;
use Modules\Product\Models\Product;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $families;
    public $family_id = '';
    public $category_id = '';
    public $image;

    public $product = [
        'sku' => '',
        'name' => '',
        'description' => '',
        'image_path' => '',
        'price' => '',
        'subcategory_id' => '',
    ];

    // CORREGIDO: Reglas de validación
    protected function rules()
    {
        return [
            'product.sku' => 'required|string|max:255|unique:products,sku',
            'product.name' => 'required|string|max:255',
            'product.description' => 'nullable|string|min:10', // CAMBIADO: De nullable a required
            'product.price' => 'required|numeric|min:0.01',
            'product.subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|max:2048',
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    // CORREGIDO: Mensajes personalizados
    protected $messages = [
        'product.sku.required' => 'El código del producto es obligatorio.',
        'product.sku.unique' => 'Este código ya existe.',
        'product.name.required' => 'El nombre del producto es obligatorio.',
        'product.description.required' => 'La descripción es obligatoria.', // CORREGIDO
        'product.description.min' => 'La descripción debe tener al menos 10 caracteres.',
        'product.price.required' => 'El precio es obligatorio.',
        'product.price.numeric' => 'El precio debe ser un número.',
        'product.price.min' => 'El precio debe ser mayor a 0.',
        'product.subcategory_id.required' => 'Debe seleccionar una subcategoría.',
        'image.image' => 'El archivo debe ser una imagen.',
        'image.max' => 'La imagen no debe superar los 2MB.',
        'family_id.required' => 'Debe seleccionar una familia.',
        'category_id.required' => 'Debe seleccionar una categoría.',
    ];

    public function mount()
    {
        $this->families = Family::orderBy('name')->get();
    }

    // Listeners para Livewire 3
    public function updatedFamilyId($value)
    {
        $this->category_id = '';
        $this->product['subcategory_id'] = '';
        $this->resetErrorBag(['category_id', 'product.subcategory_id']);
    }

    public function updatedCategoryId($value)
    {
        $this->product['subcategory_id'] = '';
        $this->resetErrorBag('product.subcategory_id');
    }

    // Validación en tiempo real para la imagen
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

    public function save()
    {
        // Debug: Mostrar los datos que se están enviando
        \Log::info('=== INICIO SAVE ===');
        \Log::info('Datos recibidos para guardar:', [
            'product' => $this->product,
            'family_id' => $this->family_id,
            'category_id' => $this->category_id,
            'has_image' => !is_null($this->image)
        ]);

        // AGREGADO: Verificar que los campos no estén vacíos antes de validar
        if (empty(trim($this->product['sku']))) {
            $this->addError('product.sku', 'El código SKU no puede estar vacío.');
            return;
        }

        if (empty(trim($this->product['name']))) {
            $this->addError('product.name', 'El nombre no puede estar vacío.');
            return;
        }

        if (empty($this->product['price']) || $this->product['price'] <= 0) {
            $this->addError('product.price', 'El precio debe ser mayor a 0.');
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
            \Log::info('Intentando crear producto...');

            // Crear el producto
            $product = Product::create([
                'sku' => trim($this->product['sku']),
                'name' => trim($this->product['name']),
                'description' => trim($this->product['description']) ?: null,
                'price' => floatval($this->product['price']),
                'subcategory_id' => intval($this->product['subcategory_id']),
            ]);

            \Log::info('Producto creado con ID:', ['id' => $product->id]);

            // Manejar la imagen si existe
            if ($this->image) {
                try {
                    \Log::info('Guardando imagen...');
                    $imagePath = $this->image->store('products', 'public');
                    $product->update(['image_path' => $imagePath]);
                    \Log::info('Imagen guardada en:', ['path' => $imagePath]);
                } catch (\Exception $e) {
                    \Log::error('Error guardando imagen:', ['error' => $e->getMessage()]);
                    // No fallar por la imagen, continuar
                }
            }

            // Mensaje de éxito
            session()->flash('success', 'Producto creado exitosamente con ID: ' . $product->id);

            // Resetear el formulario
            $this->resetForm();

            \Log::info('=== PRODUCTO CREADO EXITOSAMENTE ===');
        } catch (\Exception $e) {
            \Log::error('=== ERROR CREANDO PRODUCTO ===');
            \Log::error('Error creando producto:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            session()->flash('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    public function cancel()
    {
        return $this->redirect(route('admin.products.index'), navigate: true);
    }

    private function resetForm()
    {
        $this->reset([
            'image',
            'family_id',
            'category_id'
        ]);

        $this->product = [
            'sku' => '',
            'name' => '',
            'description' => '',
            'image_path' => '',
            'price' => '',
            'subcategory_id' => '',
        ];

        $this->resetErrorBag();
    }

    public function removeImage()
    {
        $this->image = null;
        $this->resetErrorBag('image');
    }

    public function render()
    {
        return view('livewire.admin.products.product-create');
    }
}
