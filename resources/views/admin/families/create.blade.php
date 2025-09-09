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
        'name' => 'Crear',
        'route' => route('admin.families.create'),
        'active' => true,
    ],
]">

    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-semibold mb-6">Crear Nueva Familia</h2>

            <form action="{{ route('admin.families.store') }}" method="POST">
                @csrf
                     <x-validation-errors class="mb-4"/>

                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Name') }}
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        placeholder="Ingrese el nombre de la familia"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                         />

                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.families.index') }}"
                        class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-200">
                        Cancel
                    </a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        {{ __('Crear Familia') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-4">
      {{ session('success') }}
    </div>

</x-admin-layout>
