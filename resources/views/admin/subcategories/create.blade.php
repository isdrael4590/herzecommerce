<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'SubCategorías',
        'route' => route('admin.subcategories.index'),
    ],
    [
        'name' => 'Crear',
        'route' => route('admin.subcategories.create'),
        'active' => true,
    ],
]">

    <form action="{{ route('admin.subcategories.store') }}" method="POST">
        @csrf

        <div class="card">
            <x-validation-errors class="mb-4"/>
          
            <div class="mb-4">
                <x-label class="mb-2">
                    {{ __('SubCategoría') }}
                </x-label>
                <x-select name="category_id" id="category_id" class="w-full">
                    <option value="">{{ __('Select a category') }}</option>
                    @foreach ($categories as $category)
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
                    {{ __('Crear SubCategoría') }}
                </x-button>
            </div>
        </div>
    </form>

    <div class="mt-4">
      {{ session('success') }}
    </div>

</x-admin-layout>
