<?php

namespace App\Livewire\Admin\Subcategories;

use Livewire\Component;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;
use Modules\Product\Models\Subcategory;

class SubcategoryCreate extends Component
{
    // Propiedades separadas en lugar de array
    public $family_id = '';
    public $category_id = '';
    public $name = '';
    
    public $families;
    public $availableCategories = [];

    public function mount()
    {
        $this->families = Family::all();
        $this->availableCategories = collect();
    }

    // Método que se ejecuta cuando cambia family_id
    public function updatedFamilyId($value)
    {
        \Log::info('Family ID changed to: ' . $value);
        
        $this->category_id = ''; // Reset category
        
        if ($value) {
            $this->availableCategories = Category::where('family_id', $value)->get();
            \Log::info('Categories loaded: ' . $this->availableCategories->count());
        } else {
            $this->availableCategories = collect();
        }
    }

    // Método público para llamar manualmente
    public function changeFamilia($familyId)
    {
        \Log::info('changeFamilia called with: ' . $familyId);
        $this->family_id = $familyId;
        $this->updatedFamilyId($familyId);
    }

    public function save()
    {
        $this->validate([
            'family_id' => 'required|exists:families,id',
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|min:3|max:255',
        ]);

        Subcategory::create([
            'family_id' => $this->family_id,
            'category_id' => $this->category_id,
            'name' => $this->name,
        ]);

        session()->flash('message', 'SubCategoría creada exitosamente.');

        return redirect()->route('admin.subcategories.index');
    }

    public function render()
    {
        \Log::info('Rendering - Family: ' . $this->family_id . ', Categories: ' . $this->availableCategories->count());
        
        return view('livewire.admin.subcategories.subcategory-create');
    }
}