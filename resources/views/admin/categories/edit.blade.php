<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index'),
    ],
    [
        'name' => $category->name ?? 'editar',
    ],
]">

    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card">
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('Categoria') }}
                </x-label>
                <x-select name="family_id" id="family_id" class="w-full">
                    <option value="">{{ __('Select a Familia') }}</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}" @selected($family->id == old('family_id', $category->family_id))>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Name') }}
                </label>
                <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}"
                    placeholder="Ingrese el nombre de la categoría"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-200">
                    Cancel
                </a>
                <x-danger-button onclick="confirmDelete(event)" type="button">
                    Eliminar
                </x-danger-button>
                <x-button>
                    {{ __('Actualizar Categoría') }}
                </x-button>
            </div>
        </div>
    </form>
    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" id="delete-form">
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

</x-admin-layout>
