@if (count($breadcrumbs))
<nav class="mb-4">
    <ol class="flex flex-wrap">
        @foreach ($breadcrumbs as $item)
            <li class="text-sm leading-normal text-slate-700 {{ !$loop->first ? "before:float-left before:pr-2 before:text-gray-400 before:content-['/']" : '' }}">
                @isset($item['route'])
                    <a href="{{ $item['route'] }}" class="text-blue-500 hover:underline">{{ $item['name'] }}</a>
                @else
                    <span class="text-gray-500">{{ $item['name'] }}</span>
                @endisset
            </li>
        @endforeach
    </ol>
   @if (count($breadcrumbs)>1)
        <h6 class="mb-2 text-xl font-bold leading-tight text-gray-900 md:text-2xl">
        {{ end($breadcrumbs)['name'] }}
    </h6>
   @endif
</nav>
@endif