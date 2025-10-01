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
         'name' => 'Ingeniería',
         'active' => request()->routeIs('admin.crm.*'),
         'dropdown' => true,
         'key' => 'ingenieria',
         'submenu' => [
             [
                 'icon' => 'fa-solid fa-users-gear',
                 'name' => 'Gestión de Usuarios',
                 'dropdown' => true,
                 'key' => 'user_management',
                 'active' => request()->routeIs('admin.crm.users.*') || 
                            request()->routeIs('admin.crm.roles.*') || 
                            request()->routeIs('admin.crm.permissions.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-user',
                         'name' => 'Usuarios',
                         'route' => '#', // route('admin.crm.users.index'),
                         'active' => request()->routeIs('admin.crm.users.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-user-tag',
                         'name' => 'Roles',
                         'route' => '#', // route('admin.crm.roles.index'),
                         'active' => request()->routeIs('admin.crm.roles.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-key',
                         'name' => 'Permisos',
                         'route' => '#', // route('admin.crm.permissions.index'),
                         'active' => request()->routeIs('admin.crm.permissions.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-building',
                 'name' => 'Configuración Empresa',
                 'dropdown' => true,
                 'key' => 'company_config',
                 'active' => request()->routeIs('admin.crm.companies.*') || 
                            request()->routeIs('admin.crm.departments.*') || 
                            request()->routeIs('admin.crm.business-hours.*') || 
                            request()->routeIs('admin.crm.sla-policies.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-building-user',
                         'name' => 'Empresas',
                         'route' => '#', // route('admin.crm.companies.index'),
                         'active' => request()->routeIs('admin.crm.companies.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-sitemap',
                         'name' => 'Departamentos',
                         'route' => '#', // route('admin.crm.departments.index'),
                         'active' => request()->routeIs('admin.crm.departments.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-clock',
                         'name' => 'Horarios Laborales',
                         'route' => '#', // route('admin.crm.business-hours.index'),
                         'active' => request()->routeIs('admin.crm.business-hours.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-file-contract',
                         'name' => 'Políticas SLA',
                         'route' => '#', // route('admin.crm.sla-policies.index'),
                         'active' => request()->routeIs('admin.crm.sla-policies.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-users',
                 'name' => 'Gestión de Clientes',
                 'dropdown' => true,
                 'key' => 'customer_management',
                 'active' => request()->routeIs('admin.crm.customers.*') || 
                            request()->routeIs('admin.crm.customer-types.*') || 
                            request()->routeIs('admin.crm.customer-contacts.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-tag',
                         'name' => 'Tipos de Cliente',
                         'route' => '#', // route('admin.crm.customer-types.index'),
                         'active' => request()->routeIs('admin.crm.customer-types.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-user-tie',
                         'name' => 'Clientes',
                         'route' => '#', // route('admin.crm.customers.index'),
                         'active' => request()->routeIs('admin.crm.customers.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-address-book',
                         'name' => 'Contactos',
                         'route' => '#', // route('admin.crm.customer-contacts.index'),
                         'active' => request()->routeIs('admin.crm.customer-contacts.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-location-dot',
                         'name' => 'Direcciones',
                         'route' => '#', // route('admin.crm.customer-addresses.index'),
                         'active' => request()->routeIs('admin.crm.customer-addresses.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-note-sticky',
                         'name' => 'Notas de Cliente',
                         'route' => '#', // route('admin.crm.customer-notes.index'),
                         'active' => request()->routeIs('admin.crm.customer-notes.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-toolbox',
                 'name' => 'Catálogo de Servicios',
                 'dropdown' => true,
                 'key' => 'service_catalog',
                 'active' => request()->routeIs('admin.crm.services.*') || 
                            request()->routeIs('admin.crm.service-categories.*') || 
                            request()->routeIs('admin.crm.service-contracts.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-folder-tree',
                         'name' => 'Categorías de Servicio',
                         'route' => '#', // route('admin.crm.service-categories.index'),
                         'active' => request()->routeIs('admin.crm.service-categories.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-wrench',
                         'name' => 'Servicios',
                         'route' => '#', // route('admin.crm.services.index'),
                         'active' => request()->routeIs('admin.crm.services.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-file-signature',
                         'name' => 'Contratos de Servicio',
                         'route' => '#', // route('admin.crm.service-contracts.index'),
                         'active' => request()->routeIs('admin.crm.service-contracts.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-ticket',
                 'name' => 'Sistema de Tickets',
                 'dropdown' => true,
                 'key' => 'ticket_system',
                 'active' => request()->routeIs('admin.crm.tickets.*') || 
                            request()->routeIs('admin.crm.ticket-priorities.*') || 
                            request()->routeIs('admin.crm.ticket-statuses.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-exclamation-circle',
                         'name' => 'Prioridades',
                         'route' => '#', // route('admin.crm.ticket-priorities.index'),
                         'active' => request()->routeIs('admin.crm.ticket-priorities.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-toggle-on',
                         'name' => 'Estados',
                         'route' => '#', // route('admin.crm.ticket-statuses.index'),
                         'active' => request()->routeIs('admin.crm.ticket-statuses.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-folder-open',
                         'name' => 'Categorías',
                         'route' => '#', // route('admin.crm.ticket-categories.index'),
                         'active' => request()->routeIs('admin.crm.ticket-categories.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-ticket-simple',
                         'name' => 'Tickets',
                         'route' => '#', // route('admin.crm.tickets.index'),
                         'active' => request()->routeIs('admin.crm.tickets.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-paperclip',
                         'name' => 'Adjuntos',
                         'route' => '#', // route('admin.crm.ticket-attachments.index'),
                         'active' => request()->routeIs('admin.crm.ticket-attachments.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-user-check',
                         'name' => 'Asignaciones',
                         'route' => '#', // route('admin.crm.ticket-assignments.index'),
                         'active' => request()->routeIs('admin.crm.ticket-assignments.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-arrow-up-right-dots',
                         'name' => 'Escalaciones',
                         'route' => '#', // route('admin.crm.ticket-escalations.index'),
                         'active' => request()->routeIs('admin.crm.ticket-escalations.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-book',
                 'name' => 'Base de Conocimiento',
                 'dropdown' => true,
                 'key' => 'knowledge_base',
                 'active' => request()->routeIs('admin.crm.kb-articles.*') || 
                            request()->routeIs('admin.crm.kb-categories.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-folder',
                         'name' => 'Categorías KB',
                         'route' => '#', // route('admin.crm.kb-categories.index'),
                         'active' => request()->routeIs('admin.crm.kb-categories.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-file-lines',
                         'name' => 'Artículos',
                         'route' => '#', // route('admin.crm.kb-articles.index'),
                         'active' => request()->routeIs('admin.crm.kb-articles.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-tags',
                         'name' => 'Etiquetas',
                         'route' => '#', // route('admin.crm.kb-article-tags.index'),
                         'active' => request()->routeIs('admin.crm.kb-article-tags.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-star',
                         'name' => 'Valoraciones',
                         'route' => '#', // route('admin.crm.kb-article-ratings.index'),
                         'active' => request()->routeIs('admin.crm.kb-article-ratings.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-envelope',
                 'name' => 'Comunicación',
                 'dropdown' => true,
                 'key' => 'communication',
                 'active' => request()->routeIs('admin.crm.email-templates.*') || 
                            request()->routeIs('admin.crm.notifications.*') || 
                            request()->routeIs('admin.crm.communication-logs.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-file-invoice',
                         'name' => 'Plantillas Email',
                         'route' => '#', // route('admin.crm.email-templates.index'),
                         'active' => request()->routeIs('admin.crm.email-templates.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-bell',
                         'name' => 'Notificaciones',
                         'route' => '#', // route('admin.crm.notifications.index'),
                         'active' => request()->routeIs('admin.crm.notifications.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-comments',
                         'name' => 'Logs de Comunicación',
                         'route' => '#', // route('admin.crm.communication-logs.index'),
                         'active' => request()->routeIs('admin.crm.communication-logs.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-reply-all',
                         'name' => 'Respuestas Automáticas',
                         'route' => '#', // route('admin.crm.auto-responses.index'),
                         'active' => request()->routeIs('admin.crm.auto-responses.*'),
                     ],
                 ]
             ],
             [
                 'icon' => 'fa-solid fa-chart-line',
                 'name' => 'Reportes y Analítica',
                 'dropdown' => true,
                 'key' => 'reporting_analytics',
                 'active' => request()->routeIs('admin.crm.reports.*') || 
                            request()->routeIs('admin.crm.dashboards.*') || 
                            request()->routeIs('admin.crm.metrics.*'),
                 'submenu' => [
                     [
                         'icon' => 'fa-solid fa-file-chart-line',
                         'name' => 'Plantillas de Reporte',
                         'route' => '#', // route('admin.crm.report-templates.index'),
                         'active' => request()->routeIs('admin.crm.report-templates.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-grid-2',
                         'name' => 'Dashboards',
                         'route' => '#', // route('admin.crm.dashboards.index'),
                         'active' => request()->routeIs('admin.crm.dashboards.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-chart-simple',
                         'name' => 'Métricas',
                         'route' => '#', // route('admin.crm.metrics.index'),
                         'active' => request()->routeIs('admin.crm.metrics.*'),
                     ],
                     [
                         'icon' => 'fa-solid fa-clipboard-list',
                         'name' => 'Logs de Auditoría',
                         'route' => '#', // route('admin.crm.audit-logs.index'),
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
                          (request()->routeIs('admin.crm.*') ? 'ingenieria' : '') }}',
        openSubDropdown: ''
    }">
    
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
            @foreach ($links as $link)
                <li>
                    @if(isset($link['dropdown']) && $link['dropdown'])
                        {{-- Item con dropdown nivel 1 --}}
                        <button @click="openDropdown = openDropdown === '{{ $link['key'] }}' ? '' : '{{ $link['key'] }}'; if(openDropdown !== '{{ $link['key'] }}') openSubDropdown = ''"
                            type="button"
                            class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $link['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                            <span class="inline-flex w-6 h-6 justify-center items-center">
                                <i class="{{ $link['icon'] }}"></i>
                            </span>
                            <span class="flex-1 ms-3 text-left">{{ $link['name'] }}</span>
                            <i class="fa-solid fa-chevron-down transition-transform duration-200"
                               :class="{ 'rotate-180': openDropdown === '{{ $link['key'] }}' }"></i>
                        </button>
                        
                        {{-- Submenu nivel 1 --}}
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
                                    @if(isset($sublink['dropdown']) && $sublink['dropdown'])
                                        {{-- Item con dropdown nivel 2 --}}
                                        <button @click="openSubDropdown = openSubDropdown === '{{ $sublink['key'] }}' ? '' : '{{ $sublink['key'] }}'"
                                            type="button"
                                            class="flex items-center w-full p-2 pl-8 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $sublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                            <span class="inline-flex w-5 h-5 justify-center items-center text-sm mr-2">
                                                <i class="{{ $sublink['icon'] }}"></i>
                                            </span>
                                            <span class="flex-1 text-left text-sm">{{ $sublink['name'] }}</span>
                                            <i class="fa-solid fa-chevron-down text-xs transition-transform duration-200"
                                               :class="{ 'rotate-180': openSubDropdown === '{{ $sublink['key'] }}' }"></i>
                                        </button>
                                        
                                        {{-- Submenu nivel 2 --}}
                                        <ul x-show="openSubDropdown === '{{ $sublink['key'] }}'"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="py-1 space-y-1">
                                            @foreach($sublink['submenu'] as $subsublink)
                                                <li>
                                                    <a href="{{ $subsublink['route'] }}"
                                                       class="flex items-center w-full p-2 pl-16 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $subsublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                                        <span class="inline-flex w-4 h-4 justify-center items-center text-xs mr-2">
                                                            <i class="{{ $subsublink['icon'] }}"></i>
                                                        </span>
                                                        <span class="text-sm">{{ $subsublink['name'] }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        {{-- Item normal nivel 2 --}}
                                        <a href="{{ $sublink['route'] }}"
                                           class="flex items-center w-full p-2 pl-11 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ $sublink['active'] ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                            <span class="inline-flex w-5 h-5 justify-center items-center text-sm mr-2">
                                                <i class="{{ $sublink['icon'] }}"></i>
                                            </span>
                                            {{ $sublink['name'] }}
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