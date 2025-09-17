<?php
namespace App\Livewire\Admin\Subcategories;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;
use Modules\Product\Models\Subcategory;

class SubcategoryCreate extends Component
{
    public $families;
    public $subcategory = [
        'family_id' => '',
        'name' => '',
        'category_id' => '',
    ];

    public function mount()
    {
        $this->families = Family::all();
        \Log::info('Mount ejecutado. Familias cargadas: ' . $this->families->count());
    }

    public function updatedSubcategoryFamilyId($value)
    {
        \Log::info('updatedSubcategoryFamilyId ejecutado con valor: ' . $value);
        $this->subcategory['category_id'] = '';
        
        // Forzar actualización del computed property
        $this->resetComputedProperties();
        
        \Log::info('Categorías después del cambio: ' . $this->categories->count());
    }

    // Método alternativo para debug
    public function updatedSubcategory($value, $key)
    {
        \Log::info("updatedSubcategory ejecutado. Key: {$key}, Value: {$value}");
        
        if ($key === 'family_id') {
            $this->subcategory['category_id'] = '';
            \Log::info('family_id cambió a: ' . $value);
        }
    }

    public function save()
    {
        $this->validate(
            [
                'subcategory.family_id' => 'required|exists:families,id',
                'subcategory.category_id' => 'required|exists:categories,id',
                'subcategory.name' => 'required|string|max:255',
            ],
            [],
            [
                'subcategory.family_id' => 'Familia',
                'subcategory.category_id' => 'Categoría',
                'subcategory.name' => 'Nombre',
            ]
        );

        Subcategory::create($this->subcategory);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategory created successfully',
            'text' => 'Subcategory has been created.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    #[Computed()]
    public function categories()
    {
        \Log::info('Método categories() ejecutado. family_id actual: ' . ($this->subcategory['family_id'] ?? 'null'));
        
        if (empty($this->subcategory['family_id'])) {
            \Log::info('family_id está vacío, retornando colección vacía');
            return collect();
        }

        $categories = Category::where('family_id', $this->subcategory['family_id'])->get();
        \Log::info('Categorías encontradas: ' . $categories->count());
        
        return $categories;
    }

    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-create');
    }
}