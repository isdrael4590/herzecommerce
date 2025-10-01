<div>
    <form wire:submit.prevent="save">
        <div class="card p-6">
            @if (session()->has('message'))
                <div class="alert alert-success mb-4">
                    {{ session('message') }}
                </div>
            @endif
            
            <!-- Familia -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Familia
                </label>
                <select class="w-full border border-gray-300 rounded px-3 py-2"
                        wire:model.live="family_id">
                    <option value="">Seleccione una familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </select>
                @error('family_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Categoría -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Categoría
                </label>
                <select class="w-full border border-gray-300 rounded px-3 py-2"
                        wire:model="category_id"
                        {{ empty($family_id) ? 'disabled' : '' }}>
                    @if (empty($family_id))
                        <option value="">Primero seleccione una familia</option>
                    @else
                        <option value="">Seleccione una categoría</option>
                        @foreach ($availableCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
                @error('category_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Nombre -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de la SubCategoría
                </label>
                <input type="text"
                       class="w-full border border-gray-300 rounded px-3 py-2"
                       wire:model="name"
                       placeholder="Ingrese el nombre de la SubCategoría">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            
            <!-- Debug Info -->
            <div class="mb-4 p-4 bg-gray-100 rounded text-sm">
                <strong>Debug Simplificado:</strong><br>
                Family ID: {{ $family_id ?: 'vacío' }}<br>
                Category ID: {{ $category_id ?: 'vacío' }}<br>
                Nombre: {{ $name ?: 'vacío' }}<br>
                Categorías disponibles: {{ $availableCategories->count() }}
                
                <!-- Botón de test manual -->
                <div class="mt-2">
                    <button type="button" 
                            wire:click="changeFamilia('1')"
                            class="px-3 py-1 bg-yellow-500 text-white text-xs rounded">
                        Test: Seleccionar Familia 1
                    </button>
                    @if($families->count() > 1)
                        <button type="button" 
                                wire:click="changeFamilia('{{ $families->skip(1)->first()->id ?? 2 }}')"
                                class="px-3 py-1 bg-purple-500 text-white text-xs rounded ml-2">
                            Test: Seleccionar Familia 2
                        </button>
                    @endif
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-3">
                <button type="button"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400"
                        onclick="history.back()">
                    Cancelar
                </button>
                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    Crear SubCategoría
                </button>
            </div>
        </div>
    </form>
</div>