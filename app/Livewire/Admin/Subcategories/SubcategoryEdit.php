<?php

namespace App\Livewire\Admin\Subcategories;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;

class SubcategoryEdit extends Component
{

    public $subcategory;
    public $families;
    public $subcategoryEdit = [
        'family_id' => '',
        'category_id' => '',
        'name' => '',
    ];

    public function mount($subcategory)
    {
        $this->families = Family::all();
        $this->subcategoryEdit = [
            'family_id' => $subcategory->category->family_id,
            'category_id' => $subcategory->category_id,
            'name' => $subcategory->name,
        ];
    }

    public function updatedSubcategoryEditFamilyId()
    {
        $this->subcategoryEdit['category_id'] = '';
    }

    #[Computed()]
    public function categories()
    {
        return Category::where('family_id', $this->subcategoryEdit['family_id'])->get();
    }

    public function save()
    {
        $this->validate(
            [
                'subcategoryEdit.family_id' => 'required|exists:families,id',
                'subcategoryEdit.category_id' => 'required|exists:categories,id',
                'subcategoryEdit.name' => 'required|string|max:255',
            ],
            [],
            [
                'subcategoryEdit.family_id' => 'Familia',
                'subcategoryEdit.category_id' => 'Categoría',
                'subcategoryEdit.name' => 'Nombre',
            ]
        );

        $this->subcategory->update($this->subcategoryEdit);
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => 'Subcategory updated successfully',
            'text' => 'Subcategory has been updated.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);
        return redirect()->route('admin.subcategories.index');
    }


    public function render()
    {
        return view('livewire.admin.subcategories.subcategory-edit');
    }
}
