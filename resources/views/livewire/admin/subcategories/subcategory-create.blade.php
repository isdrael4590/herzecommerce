<div>
    <form wire:submit.prevent="save">
        <div class="card">
            <x-validation-errors class="mb-4" />
            
            <!-- Familia -->
            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('Familia') }}
                </x-label>
                <x-select class="w-full" wire:model.live="subcategory.family_id" wire:change="$refresh">
                    <option value="">{{ __('Seleccione una familia') }}</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>
            </div>

            <!-- Categoría -->
            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('Categoría') }}
                </x-label>
                <x-select class="w-full" wire:model.live="subcategory.category_id">
                    @if(empty($subcategory['family_id']))
                        <option value="">{{ __('Primero seleccione una familia') }}</option>
                    @else
                        <option value="">{{ __('Seleccione una categoría') }}</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    @endif
                </x-select>
            </div>

            <!-- Nombre -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Nombre') }}
                </label>
                <x-input class="w-full" wire:model="subcategory.name" 
                         placeholder="Ingrese el nombre de la SubCategoría" />
            </div>

            <!-- Botón -->
            <div class="flex justify-end space-x-3">
                <x-button>
                    {{ __('Crear SubCategoría') }}
                </x-button>
    <button type="button" wire:click="testFamilyChange">Test Family Change</button>

            </div>
        </div>
    </form>

    <!-- Debug temporal -->
    <div class="mt-4 p-4 bg-gray-100 rounded">
        <h3 class="font-bold">Debug Info:</h3>
        <p><strong>Family ID:</strong> {{ $subcategory['family_id'] ?: 'Vacío' }}</p>
        <p><strong>Category ID:</strong> {{ $subcategory['category_id'] ?: 'Vacío' }}</p>
        <p><strong>Nombre:</strong> {{ $subcategory['name'] ?: 'Vacío' }}</p>
        <p><strong>Total Familias:</strong> {{ count($families) }}</p>
        <p><strong>Total Categorías:</strong> {{ $this->categories->count() }}</p>
    </div>
    @dump($subcategory, $this->categories)
</div>