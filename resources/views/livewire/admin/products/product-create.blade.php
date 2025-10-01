<!-- Envuelve todo en un solo div contenedor -->
<div>
    <!-- Mensajes de éxito/error -->
    @if (session()->has('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        {{ session('success') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-md">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">
                        {{ session('error') }}
                    </p>
                </div>
            </div>
        </div>
    @endif

    <!-- Sección de imagen - -->
    <div class="mb-6">
        <!-- Formulario principal del producto -->
        <form wire:submit.prevent="save" class="space-y-6">
            <figure class="relative">
                <!-- Contenedor con altura fija para mantener la forma -->
                <div
                    class="aspect-[16/9] w-full bg-gray-100 rounded-lg overflow-hidden relative border-2 border-dashed border-gray-300">
                    @if ($image)
                        <!-- CAMBIO PRINCIPAL: Usar data URI para mostrar la imagen -->
                        <img class="w-full h-full object-cover"
                            src="data:{{ $image->getMimeType() }};base64,{{ base64_encode($image->get()) }}"
                            alt="Imagen del producto">

                        <!-- Overlay con botones cuando hay imagen -->
                        <div
                            class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-30 transition-all duration-200 flex items-center justify-center group">
                            <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex gap-2">
                                <!-- Botón cambiar imagen -->
                                <label
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg cursor-pointer hover:bg-blue-700 transition-colors flex items-center shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Cambiar
                                    <input type="file" class="hidden" accept="image/*" wire:model="image"
                                        wire:loading.attr="disabled">
                                </label>

                                <!-- Botón eliminar imagen -->
                                <button wire:click="removeImage" type="button"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors flex items-center shadow-lg">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    Eliminar
                                </button>
                            </div>
                        </div>
                    @else
                        <!-- Placeholder cuando no hay imagen -->
                        <div
                            class="w-full h-full flex flex-col items-center justify-center text-gray-400 hover:text-gray-600 transition-colors">
                            <svg class="h-16 w-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium mb-2">Agregar imagen del producto</p>
                            <p class="text-sm text-center mb-4 max-w-xs">Sube una imagen en formato JPG, PNG o GIF.
                                Tamaño
                                máximo 2MB.</p>

                            <!-- Botón agregar imagen -->
                            <label
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg cursor-pointer hover:bg-blue-700 transition-colors flex items-center shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                                Seleccionar imagen
                                <input type="file" class="hidden" accept="image/*" wire:model="image"
                                    wire:loading.attr="disabled">
                            </label>
                        </div>
                    @endif

                    <!-- Indicador de carga -->
                    <div wire:loading wire:target="image"
                        class="absolute inset-0 bg-black bg-opacity-75 flex items-center justify-center rounded-lg">
                        <div class="text-white text-center">
                            <svg class="animate-spin h-12 w-12 mx-auto mb-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium">Cargando imagen...</p>
                            <p class="text-sm opacity-75">Por favor espere</p>
                        </div>
                    </div>
                </div>

                <!-- Mensaje de error para la imagen -->
                @error('image')
                    <div class="mt-2 p-3 bg-red-50 border border-red-200 rounded-md">
                        <p class="text-red-600 text-sm flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    </div>
                @enderror
            </figure>

            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div>
                    <h4 class="text-sm font-medium text-blue-900 mb-1">Recomendaciones para la imagen</h4>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Usa imágenes con relación de aspecto 16:9 para mejor visualización</li>
                        <li>• Resolución recomendada: mínimo 800x450 píxeles</li>
                        <li>• Formatos permitidos: JPG, PNG, GIF</li>
                        <li>• Tamaño máximo: 2MB</li>
                    </ul>
                </div>
            </div>

            <!-- SKU - DEBE APARECER PRIMERO -->
            <div>

                <x-label class="mb-2">
                    Código (SKU) *

                </x-label>
                <input type="text" wire:model="product.sku" id="sku"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ejemplo: SKU001, PROD-123" required>
                @error('product.sku')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nombre -->
            <div>


                <x-label class="mb-2" for="name">
                    Nombre del producto *

                </x-label>


                <input type="text" wire:model="product.name" id="name"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Ingrese el nombre del producto" required>
                @error('product.name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Precio -->
            <div>

                <x-label class="mb-2" for="price">
                    Precio *

                </x-label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">$</span>
                    <input type="number" wire:model="product.price" id="price" step="0.01" min="0.01"
                        class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        placeholder="0.00" required>
                </div>
                @error('product.price')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Selección de familia -->
            <div>

                <x-label class="mb-2" for="family_id">
                    Familia *

                </x-label>

                <x-select wire:model.live="family_id" id="family_id"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                    required>
                    <option value="">Seleccionar familia</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </x-select>
                @error('family_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Selección de categoría -->
            @if ($this->categories->count())
                <div>

                    <x-label class="mb-2" for="category_id">
                        Categoría *
                    </x-label>

                    <x-select wire:model.live="category_id" id="category_id"
                        class="w-full"
                        required>
                        <option value="">Seleccionar categoría</option>
                        @foreach ($this->categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </x-select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Selección de subcategoría -->
            @if ($this->subcategories->count())
                <div>

                    <x-label class="mb-2" for="subcategory_id">
                        Subcategoría *

                    </x-label>
                    <x-select wire:model="product.subcategory_id" id="subcategory_id"
                        class="w-full"
                        required>
                        <option value="">Seleccionar subcategoría</option>
                        @foreach ($this->subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach
                    </x-select>
                    @error('product.subcategory_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <!-- Descripción -->
            <div>

                <x-label class="mb-2" for="description">
                    Descripción *

                </x-label>
                <textarea wire:model="product.description" id="description" rows="4"
                    class="w-full"
                    placeholder="Descripción detallada del producto" ></textarea>
                @error('product.description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Debug info (TEMPORAL) -->
            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-md">
                <h4 class="text-sm font-medium text-yellow-800 mb-2">Info Debug (temporal):</h4>
                <div class="text-xs text-yellow-700 space-y-1">
                    <p><strong>SKU:</strong> "{{ $product['sku'] ?? 'vacío' }}"</p>
                    <p><strong>Name:</strong> "{{ $product['name'] ?? 'vacío' }}"</p>
                    <p><strong>Price:</strong> "{{ $product['price'] ?? 'vacío' }}"</p>
                    <p><strong>Family ID:</strong> {{ $family_id ?: 'no seleccionado' }}</p>
                    <p><strong>Category ID:</strong> {{ $category_id ?: 'no seleccionado' }}</p>
                    <p><strong>Subcategory ID:</strong> {{ $product['subcategory_id'] ?? 'no seleccionado' }}</p>
                    <p><strong>Image:</strong> {{ $image ? 'Sí' : 'No' }}</p>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200">
                <button type="button" wire:click="cancel"
                    class="px-6 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Cancelar
                </button>
                <button type="submit" wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed" onclick="console.log('Botón clickeado')"
                    class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <span wire:loading.remove>Crear producto</span>
                    <span wire:loading>Creando...</span>
                </button>
            </div>
        </form>
    </div>
</div>
