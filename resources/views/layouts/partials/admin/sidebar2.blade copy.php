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
         'icon' => 'fa-solid fa-helmet-safety',
         'name' => 'CRM Ingeniería',
         'active' => request()->routeIs('admin.crm.*'),
         'dropdown' => true,
         'key' => 'crm',
         'submenu' => [
             // MÓDULO 1: Gestión de Usuarios
             [
                 'icon' => 'fa-solid fa-users-gear',
                 'name' => 'Usuarios y Permisos',
                 'dropdown' => true,
                 'key' => 'users_permissions',
                 'active' => request()->routeIs('admin.crm.users.*') || 
                            request()->routeIs('admin.crm.roles.*') || 
                            request()->routeIs('admin.crm.permissions.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-user',
                         'name' => 'Usuarios',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.users.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-user-tag',
                         'name' => 'Roles',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.roles.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-key',
                         'name' => 'Permisos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.permissions.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 2: Gestión de Clientes
             [
                 'icon' => 'fa-solid fa-users',
                 'name' => 'Clientes',
                 'dropdown' => true,
                 'key' => 'customers',
                 'active' => request()->routeIs('admin.crm.customers.*') || 
                            request()->routeIs('admin.crm.customer-types.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-tag',
                         'name' => 'Tipos de Cliente',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customer-types.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-building',
                         'name' => 'Clientes',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customers.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-address-book',
                         'name' => 'Contactos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customer-contacts.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-location-dot',
                         'name' => 'Direcciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customer-addresses.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-map-location-dot',
                         'name' => 'Sedes',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customer-sites.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-note-sticky',
                         'name' => 'Notas',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.customer-notes.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 3: Productos y Servicios
             [
                 'icon' => 'fa-solid fa-toolbox',
                 'name' => 'Productos y Servicios',
                 'dropdown' => true,
                 'key' => 'products_services',
                 'active' => request()->routeIs('admin.crm.product-categories.*') || 
                            request()->routeIs('admin.crm.crm-products.*') || 
                            request()->routeIs('admin.crm.service-types.*') || 
                            request()->routeIs('admin.crm.service-contracts.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-folder-tree',
                         'name' => 'Categorías Producto',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.product-categories.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-box-open',
                         'name' => 'Equipos Médicos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.crm-products.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-wrench',
                         'name' => 'Tipos de Servicio',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.service-types.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-file-signature',
                         'name' => 'Contratos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.service-contracts.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-shield-halved',
                         'name' => 'Cobertura de Contratos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.contract-coverage.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 4: Inventario y Equipos
             [
                 'icon' => 'fa-solid fa-warehouse',
                 'name' => 'Inventario',
                 'dropdown' => true,
                 'key' => 'inventory',
                 'active' => request()->routeIs('admin.crm.equipment.*') || 
                            request()->routeIs('admin.crm.parts.*') || 
                            request()->routeIs('admin.crm.inventory-movements.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-boxes-stacked',
                         'name' => 'Equipos Instalados',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.equipment-inventory.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-puzzle-piece',
                         'name' => 'Repuestos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.parts-inventory.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-truck-fast',
                         'name' => 'Movimientos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.inventory-movements.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 5: Sistema de Tickets (CORE)
             [
                 'icon' => 'fa-solid fa-ticket',
                 'name' => 'Tickets',
                 'dropdown' => true,
                 'key' => 'tickets',
                 'active' => request()->routeIs('admin.crm.tickets.*') || 
                            request()->routeIs('admin.crm.ticket-priorities.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-ticket-simple',
                         'name' => 'Todos los Tickets',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.tickets.index'),
                     ],
                     [
                         'icon' => 'fa-solid fa-plus-circle',
                         'name' => 'Crear Ticket',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.tickets.create'),
                     ],
                     [
                         'icon' => 'fa-solid fa-exclamation-triangle',
                         'name' => 'Prioridades',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.ticket-priorities.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-list-check',
                         'name' => 'Estados',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.ticket-statuses.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-folder-open',
                         'name' => 'Categorías',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.ticket-categories.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-arrow-up-right-dots',
                         'name' => 'Escalaciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.ticket-escalations.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 6: Ventas y Oportunidades
             [
                 'icon' => 'fa-solid fa-chart-line',
                 'name' => 'Ventas',
                 'dropdown' => true,
                 'key' => 'sales',
                 'active' => request()->routeIs('admin.crm.opportunities.*') || 
                            request()->routeIs('admin.crm.quotations.*') || 
                            request()->routeIs('admin.crm.sales-stages.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-funnel-dollar',
                         'name' => 'Pipeline',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.sales-stages.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-bullseye',
                         'name' => 'Oportunidades',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.sales-opportunities.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-file-invoice-dollar',
                         'name' => 'Cotizaciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.quotations.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-hand-holding-dollar',
                         'name' => 'Comisiones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.commissions.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 7: Aplicaciones Clínicas
             [
                 'icon' => 'fa-solid fa-user-doctor',
                 'name' => 'Aplicaciones Clínicas',
                 'dropdown' => true,
                 'key' => 'clinical',
                 'active' => request()->routeIs('admin.crm.training.*') || 
                            request()->routeIs('admin.crm.clinical-cases.*') || 
                            request()->routeIs('admin.crm.application-support.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-graduation-cap',
                         'name' => 'Programas de Capacitación',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.training-programs.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-calendar-days',
                         'name' => 'Sesiones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.training-sessions.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-user-graduate',
                         'name' => 'Asistentes',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.training-attendees.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-briefcase-medical',
                         'name' => 'Casos Clínicos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.clinical-cases.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-hands-helping',
                         'name' => 'Soporte Aplicaciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.application-support.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 8: Mantenimientos
             [
                 'icon' => 'fa-solid fa-screwdriver-wrench',
                 'name' => 'Mantenimientos',
                 'dropdown' => true,
                 'key' => 'maintenance',
                 'active' => request()->routeIs('admin.crm.maintenance.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-clipboard-list',
                         'name' => 'Planes',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.maintenance-plans.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-calendar-check',
                         'name' => 'Calendario',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.maintenance-schedules.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-list-ul',
                         'name' => 'Checklists',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.maintenance-checklists.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-clipboard-check',
                         'name' => 'Ejecuciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.maintenance-executions.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 9: Facturación
             [
                 'icon' => 'fa-solid fa-file-invoice',
                 'name' => 'Facturación',
                 'dropdown' => true,
                 'key' => 'billing',
                 'active' => request()->routeIs('admin.crm.invoices.*') || 
                            request()->routeIs('admin.crm.payments.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-file-invoice-dollar',
                         'name' => 'Facturas',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.invoices.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-money-check-dollar',
                         'name' => 'Pagos',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.payments.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 10: Comunicaciones
             [
                 'icon' => 'fa-solid fa-envelope-open-text',
                 'name' => 'Comunicaciones',
                 'dropdown' => true,
                 'key' => 'communications',
                 'active' => request()->routeIs('admin.crm.email-templates.*') || 
                            request()->routeIs('admin.crm.notifications.*') || 
                            request()->routeIs('admin.crm.communication-logs.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-file-lines',
                         'name' => 'Plantillas Email',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.email-templates.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-bell',
                         'name' => 'Notificaciones',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.notifications.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-comments',
                         'name' => 'Logs de Comunicación',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.communication-logs.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-robot',
                         'name' => 'Respuestas Automáticas',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.auto-responses.*'),
                     ],
                 ]
             ],
             
             // MÓDULO 11: Reportes
             [
                 'icon' => 'fa-solid fa-chart-pie',
                 'name' => 'Reportes y Analítica',
                 'dropdown' => true,
                 'key' => 'reports',
                 'active' => request()->routeIs('admin.crm.reports.*') || 
                            request()->routeIs('admin.crm.dashboards.*') || 
                            request()->routeIs('admin.crm.metrics.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-table',
                         'name' => 'Plantillas de Reporte',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.report-templates.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-dashboard',
                         'name' => 'Dashboards',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.dashboards.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-chart-simple',
                         'name' => 'Métricas KPI',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.metrics.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-clipboard-list',
                         'name' => 'Auditoría',
                         'route' => '#',
                         'active' => request()->routeIs('admin.crm.audit-logs.*'),
                     ],
                 ]
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
                          request()->routeIs('admin.products.*') ? 'productos' : 
                          (request()->routeIs('admin.crm.*') ? 'crm' : '') }}',
        openSubDropdown: ''
    }">
    
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @if(isset($link['dropdown']) && $link['dropdown'])
                        {{-- Dropdown nivel 1 --}}
                        <button @click="openDropdown = openDropdown === '{{ $link['key'] }}' ? '' : '{{ $link['key'] }}'; if(openDropdown !== '{{ $link['key'] }}') openSubDropdown = ''"
                            type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                               :class="{ 'rotate-180': openDropdown === '{{ $link['key'] }}' }"></i>
                        </button>
                        
                        {{-- Submenu nivel 1 --}}
                        <ul x-show="openDropdown === '{{ $link['key'] }}'"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-1"
                            class="mt-2 space-y-1">
                            @foreach($link['submenu'] as $sublink)
                                <li>
                                    @if(isset($sublink['dropdown']) && $sublink['dropdown'])
                                        {{-- Dropdown nivel 2 --}}
                                        <button @click="openSubDropdown = openSubDropdown === '{{ $sublink['key'] }}' ? '' : '{{ $sublink['key'] }}'"
                                            type="button"
                                            class="flex items-center w-full p-2 pl-8 text-sm text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $sublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                            <span class="inline-flex w-5 h-5 justify-center items-center mr-2">
                                                <i class="{{ $sublink['icon'] }} text-xs"></i>
                                            </span>
                                            <span class="flex-1 text-left rtl:text-right whitespace-nowrap">{{ $sublink['name'] }}</span>
                                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                                               :class="{ 'rotate-180': openSubDropdown === '{{ $sublink['key'] }}' }"></i>
                                        </button>
                                        
                                        {{-- Submenu nivel 2 --}}
                                        <ul x-show="openSubDropdown === '{{ $sublink['key'] }}'"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 -translate-y-1"
                                            x-transition:enter-end="opacity-100 translate-y-0"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 translate-y-0"
                                            x-transition:leave-end="opacity-0 -translate-y-1"
                                            class="mt-1 space-y-1">
                                            @foreach($sublink['submenu'] as $subsublink)
                                                <li>
                                                    <a href="{{ $subsublink['route'] }}"
                                                       class="flex items-center w-full p-2 pl-14 text-sm text-gray-700 rounded-lg dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $subsublink['active'] ? 'bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white' : '' }}">
                                                        <span class="inline-flex w-4 h-4 justify-center items-center mr-2">
                                                            <i class="{{ $subsublink['icon'] }} text-xs"></i>
                                                        </span>
                                                        <span class="whitespace-nowrap">{{ $subsublink['name'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{-- Item normal nivel 2 --}}
                                        <a href="{{ $sublink['route'] }}"
                                           class="flex items-center w-full p-2 pl-11 text-sm text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $sublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                            <span class="inline-flex w-5 h-5 justify-center items-center mr-2">
                                                <i class="{{ $sublink['icon'] }} text-xs"></i>
                                            </span>
                                            <span>{{ $sublink['name'] }}</span>
                                        </a>
                                    @endif
                                </li>
                                @endforeach
                        </ul>
                    @else
                        {{-- Item normal nivel 1 --}}
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