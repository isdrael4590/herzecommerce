<x-admin-layout :breadcrumbs="[
    [
        'name' => 'Dashboard',
        'route' => route('admin.dashboard'),
    ],
    [
        'name' => 'Categorías',
        'route' => route('admin.categories.index'),
        'active' => true,
    ],
]">

    <x-slot name="actions">
        <a class="btn btn-blue" href="{{ route('admin.categories.create') }}">
            {{ __('Add Category') }}
        </a>
    </x-slot>

    @if ($categories->count())

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
                    @foreach ($categories as $category)
                        <tr class="text-center">
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $category->id }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $category->name }}
                            </td>
                              <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                {{ $category->family->name }}
                            </td>
                            <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                                {{-- <a href="{{ route('admin.categories.show', $category) }}"
                                        class="text-green-600 hover:underline ms-2">View</a> --}}
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    style="display: inline;"
                                    onsubmit="return confirmDelete(event, '{{ $category->name }}')">
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
            {{ $categories->links() }}
        </div>
    @else
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert">
            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">Info alert!</span> Todavía no hay Categorias registradas.
            </div>
        </div>
    @endif


</x-admin-layout>
<script>
    if (document.getElementById("search-table") && typeof simpleDatatables.DataTable !== 'undefined') {
        const dataTable = new simpleDatatables.DataTable("#search-table", {
            searchable: true,
            sortable: false
        });
    }

    function confirmDelete(event, familyName) {
        event.preventDefault();

        Swal.fire({
            title: "¿Estás seguro?",
            text: `No podrás revertir la eliminación de "${familyName}"!`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Sí, eliminarlo!",
            cancelButtonText: "Cancelar"
        }).then((result) => {
            if (result.isConfirmed) {
                // Enviar el formulario
                event.target.submit();
            }
        });

        return false;
    }
</script>
