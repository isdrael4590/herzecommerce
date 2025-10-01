<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
        'active' => true,
    ],
]">


    <x-slot name="actions">
        <a class="btn btn-blue" href="{{ route('admin.products.create') }}">
            {{ __('Add product') }}
        </a>
    </x-slot>

    @if ($products->count())

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
                                SKU
                            </span>
                        </th>
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Nombre
                            </span>
                        </th>
                        
                        <th class="text-center">
                            <span class="flex items-center justify-center">
                                Precio
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
                    @foreach ($products as $product)
                        <tr class="text-center">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $product->id }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $product->SKU }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $product->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $product->price }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirmDelete(event, '{{ $product->name }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:underline ms-2 bg-transparent border-none cursor-pointer">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @else
        <p class="text-center text-gray-500">{{ __('No categories found.') }}</p>
    @endif
</x-admin-layout>