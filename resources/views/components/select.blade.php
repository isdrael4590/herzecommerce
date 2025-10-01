<select {!! $attributes->merge(['class' => 'bw-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500']) !!}>
    {{ $slot }}
</select>