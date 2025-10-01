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
        'name' => 'Detalle Producto',
        'route' => route('admin.products.create'),
        'active' => true,
    ],
]">

   
@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                <p class="mt-2 text-gray-600">SKU: {{ $product->sku }}</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.products.edit', $product->id) }}" 
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar
                </a>
                <a href="{{ route('admin.products.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Volver a productos
                </a>
            </div>
        </div>
    </div>

    <!-- Contenido principal -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
            
            <!-- Imagen del producto -->
            <div class="space-y-4">
                <div class="aspect-[16/9] w-full bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                    @if($product->image_path)
                        <img src="{{ Storage::disk('public')->url($product->image_path) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex flex-col items-center justify-center text-gray-400">
                            <svg class="h-16 w-16 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" 
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="text-lg font-medium">Sin imagen</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información del producto -->
            <div class="space-y-6">
                
                <!-- Precio -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-3xl font-bold text-gray-900">${{ number_format($product->price, 2) }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Precio unitario</p>
                </div>

                <!-- Información básica -->
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Información del producto</h3>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <!-- SKU -->
                            <div class="col-span-2 sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">Código (SKU)</dt>
                                <dd class="mt-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md font-mono">
                                    {{ $product->sku }}
                                </dd>
                            </div>

                            <!-- ID -->
                            <div class="col-span-2 sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-500">ID</dt>
                                <dd class="mt-1 text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded-md">
                                    #{{ $product->id }}
                                </dd>
                            </div>
                        </div>
                    </div>

                    <!-- Categorización -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Categorización</h4>
                        <div class="flex flex-wrap gap-2">
                            @if($product->subcategory)
                                <!-- Familia -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    {{ $product->subcategory->category->family->name }}
                                </span>
                                
                                <!-- Categoría -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $product->subcategory->category->name }}
                                </span>
                                
                                <!-- Subcategoría -->
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    {{ $product->subcategory->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Sin categorizar
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-500 mb-2">Descripción</h4>
                        <div class="bg-gray-50 p-4 rounded-md">
                            <p class="text-sm text-gray-900 leading-relaxed">
                                {{ $product->description ?: 'Sin descripción disponible' }}
                            </p>
                        </div>
                    </div>

                    <!-- Fechas -->
                    <div class="pt-4 border-t border-gray-200">
                        <h4 class="text-sm font-medium text-gray-500 mb-3">Información de registro</h4>
                        <div class="grid grid-cols-1 gap-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Creado:</span>
                                <span class="text-gray-900">{{ $product->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Última actualización:</span>
                                <span class="text-gray-900">{{ $product->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
            <div class="flex justify-between items-center">
                <div class="text-sm text-gray-500">
                    Producto ID: {{ $product->id }}
                </div>
                <div class="flex space-x-3">
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" 
                          onsubmit="return confirm('¿Está seguro de que desea eliminar este producto?')" 
                          class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm rounded-md hover:bg-red-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar producto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

</x-admin-layout>
