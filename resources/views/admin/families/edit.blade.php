<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Familias',
        'route' => route('admin.families.index'),
    ],
    [
        'name' => $family->name,
        'route' => route('admin.families.edit', $family),
    ],
]">

    <div class="max-w-2xl mx-auto">
        <div class="card">
            <h2 class="text-2xl font-semibold mb-6">Editar Familia</h2>

            <form action="{{ route('admin.families.update', $family) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name', $family->name) }}"
                        placeholder="Ingrese el nombre de la familia"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required autofocus />

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.families.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-200">
                        Cancel
                    </a>
                    <x-danger-button onclick="confirmDelete(event)" type="button">
                        Eliminar
                    </x-danger-button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        {{ __('Actualizar Familia') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-4">
        {{ session('success') }}
    </div>
    <form action="{{ route('admin.families.destroy', $family) }}" method="POST" id="delete-form">
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
