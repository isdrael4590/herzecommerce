<?php

namespace App\Livewire;

use Livewire\Component;
use Modules\Product\Models\Family;
use Modules\Product\Models\Category;

class TestSelect extends Component
{
    public $selectedFamily = '';
    public $selectedCategory = '';
    public $testInput = '';
    
    public function mount()
    {
        \Log::info('TestSelect mounted');
    }
    
    public function updatedSelectedFamily($value)
    {
        \Log::info('Family changed to: ' . $value);
        $this->selectedCategory = '';
        \Log::info('Category reset');
    }
    
    public function updatedTestInput($value)
    {
        \Log::info('Input changed to: ' . $value);
    }
    
    public function testButton()
    {
        \Log::info('Test button clicked');
        $this->testInput = 'Button clicked at ' . now()->format('H:i:s');
    }
    
    public function getAvailableCategoriesProperty()
    {
        if (empty($this->selectedFamily)) {
            return collect();
        }
        
        return Category::where('family_id', $this->selectedFamily)->get();
    }

    public function render()
    {
        $families = Family::all();
        
        \Log::info('TestSelect rendering. Selected family: ' . $this->selectedFamily);
        \Log::info('Available categories: ' . $this->availableCategories->count());
        
        return view('livewire.test-select', compact('families'));
    }
}