<div>
    <form wire:submit.prevent="save">

        <div class="card">
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('Familia') }}
                </x-label>
                <x-select class="w-full" wire:model.live="subcategoryEdit.family_id">
                    <option value="" disabled selected> {{ __('Seleccione una familia') }} </option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}">
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('SubCategoría') }}
                </x-label>
                <x-select class="w-full" wire:model.live="subcategoryEdit.category_id">
                    <option value="">{{ __('Select a category') }}</option>
                    @foreach ($this->categories as $category)
                        <option value="{{ $category->id }}" @selected($category->id == old('category_id'))>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Nombre') }}
                </label>
                <x-input class="w-full" wire:model="subcategoryEdit.name"
                    placeholder="Ingrese el nombre de la Familia" />


            </div>

            <div class="flex justify-end space-x-3">

                <x-danger-button onclick="confirmDelete(event)" type="button">
                    {{ __('Eliminar') }}
                </x-danger-button>
                <x-button>
                    {{ __('Actualizar SubFamilia') }}
                </x-button>
            </div>
        </div>
    </form>

    @dump($this->categories)

    <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST" id="delete-form">
        @csrf
        @method('DELETE')

    </form>
    @push('js')
        <script>
            function confirmDelete(event) {
                event.preventDefault(); // Prevenir el envío inmediato del formulario

                Swal.fire({
                    title: "¿Estás seguro?",
                    text: "No podrás revertir esto!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sí, eliminarlo!",
                    cancelButtonText: "Cancelar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Enviar el formulario de eliminación directamente
                        document.getElementById('delete-form').submit();
                    }
                });
            }
        </script>
    @endpush
</div>
