@php
 $links = [
     [
         'icon' => 'fa-solid fa-gauge-high',
         'name' => 'Dashboard',
         'route' => route('admin.dashboard'),
         'active' => request()->routeIs('admin.dashboard'),
     ],
     [
         'icon' => 'fa-solid fa-store',
         'name' => 'Productos',
         'active' => request()->routeIs('admin.families.*') || 
                     request()->routeIs('admin.categories.*') || 
                     request()->routeIs('admin.subcategories.*') || 
                     request()->routeIs('admin.products.*'),
         'dropdown' => true,
         'key' => 'productos',
         'submenu' => [
             [
                 'icon' => 'fa-solid fa-layer-group',
                 'name' => 'Familias',
                 'route' => route('admin.families.index'),
                 'active' => request()->routeIs('admin.families.*'),
             ],
             [
                 'icon' => 'fa-solid fa-tags',
                 'name' => 'Categorías',
                 'route' => route('admin.categories.index'),
                 'active' => request()->routeIs('admin.categories.*'),
             ],
             [
                 'icon' => 'fa-solid fa-list',
                 'name' => 'Subcategorías',
                 'route' => route('admin.subcategories.index'),
                 'active' => request()->routeIs('admin.subcategories.*'),
             ],
             [
                 'icon' => 'fa-solid fa-box',
                 'name' => 'Productos',
                 'route' => route('admin.products.index'),
                 'active' => request()->routeIs('admin.products.*'),
             ],
         ]
     ],
          [
         'icon' => 'fa-solid fa-store',
         'name' => 'CRM',
         'active' => request()->routeIs('admin.families.*') || 
                     request()->routeIs('admin.categories.*') || 
                     request()->routeIs('admin.subcategories.*') || 
                     request()->routeIs('admin.products.*'),
         'dropdown' => true,
         'key' => 'CRM',
         'submenu' => [

             [
                 'icon' => 'fa-solid fa-box',
                 'name' => 'CRM',
                 'route' => route('admin.products.index'),
                 'active' => request()->routeIs('admin.products.*'),
             ],
         ]
     ],
 ];
@endphp

<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    :class="{
        'translate-x-0 ease-out': sidebarOpen,
        '-translate-x-full ease-in': !sidebarOpen
    }"
    aria-label="Sidebar"
    x-data="{ 
        openDropdown: '{{ request()->routeIs('admin.families.*') || 
                          request()->routeIs('admin.categories.*') || 
                          request()->routeIs('admin.subcategories.*') || 
                          request()->routeIs('admin.products.*') ? 'productos' : '' }}' 
    }">
    
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $index => $link)
                <li>
                    @if(isset($link['dropdown']) && $link['dropdown'])
                        {{-- Item con dropdown --}}
                        <button @click="openDropdown = openDropdown === '{{ $link['key'] }}' ? '' : '{{ $link['key'] }}'"
                            type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left">{{ $link['name'] }}</span>
                            <i class="fa-solid fa-chevron-down transition-transform duration-200"
                               :class="{ 'rotate-180': openDropdown === '{{ $link['key'] }}' }"></i>
                        </button>
                        
                        {{-- Submenu --}}
                        <ul x-show="openDropdown === '{{ $link['key'] }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 transform scale-95"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-95"
                            class="py-2 space-y-2">
                            @foreach($link['submenu'] as $sublink)
                                <li>
                                    <a href="{{ $sublink['route'] }}"
                                       class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $sublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                        <span class="inline-flex w-5 h-5 justify-center items-center text-sm mr-2">
                                            <i class="{{ $sublink['icon'] }}"></i>
                                        </span>
                                        {{ $sublink['name'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        {{-- Item normal --}}
                        <a href="{{ $link['route'] }}"
                            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="ms-3">{{ $link['name'] }}</span>
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</aside>