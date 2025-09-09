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
        'name' => 'Crear',
    ],
]">

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="card">
            <x-validation-errors class="mb-4"/>
          
            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('Categoria') }}
                </x-label>
                <x-select name="family_id" id="family_id" class="w-full">
                    <option value="">{{ __('Select a family') }}</option>
                    @foreach ($families as $family)
                        <option value="{{ $family->id }}" @selected($family->id == old('family_id'))>
                            {{ $family->name }}
                        </option>
                    @endforeach
                </x-select>

            </div>
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('Name') }}
                </label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Ingrese el nombre de la categoría"
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                     />

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 transition duration-200">
                    Cancel
                </a>

                <x-button>
                    {{ __('Crear Categoría') }}
                </x-button>
            </div>
        </div>
    </form>


</x-admin-layout>
