<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Subcategorías',
        'route' => route('admin.categories.index'),
        'active' => true,
    ],
]">

    <x-slot name="actions">
        <a class="btn btn-blue" href="{{ route('admin.subcategories.create') }}">
            {{ __('Add Subcategory') }}
        </a>
    </x-slot>

    @if ($subcategories->count())

        <div class="relative overflow-x-auto">
            <table id="search-table" class="w-full text-center">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                ID
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Nombre
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Categoría
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Familia
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Acción
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subcategories as $subcategory)
                        <tr class="text-center">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $subcategory->id }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $subcategory->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $subcategory->category->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $subcategory->category->family->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.subcategories.edit', $subcategory) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $subcategories->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">{{ __('No categories found.') }}</p>
    @endif
</x-admin-layout>
