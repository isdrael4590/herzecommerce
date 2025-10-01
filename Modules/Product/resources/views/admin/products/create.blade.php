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
        'name' => 'Nuevo',
        'route' => route('admin.products.create'),
        'active' => true,
    ],
]">

   

    @livewire('admin.products.product-create')
    {{-- @livewire('test-select') --}}

</x-admin-layout>
