<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Productos',
        'route' => route('admin.products.index'),
    ],
    [
        'name' => 'Editar',
        'active' => true,
    ],
]">
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="mb-6">
            <p class="mt-1 text-sm text-gray-600">Modifica la información del producto</p>
        </div>

        @livewire('admin.products.product-edit', ['product' => $product])
    </div>

</x-admin-layout>
