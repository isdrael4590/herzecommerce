<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Test Livewire + Jetstream</h2>
    
    <!-- Test Input - Debería funcionar inmediatamente -->
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
        <h3 class="font-semibold mb-3">Test 1: Input Reactivo</h3>
        <input type="text" 
               wire:model.live="testInput"
               class="w-full border border-gray-300 rounded px-3 py-2"
               placeholder="Escribe algo aquí...">
        <p class="mt-2 text-sm">Valor actual: <strong>{{ $testInput ?: 'vacío' }}</strong></p>
    </div>
    
    <!-- Test Button -->
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded">
        <h3 class="font-semibold mb-3">Test 2: Button Click</h3>
        <button wire:click="testButton"
                class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
            Click Me
        </button>
        <p class="mt-2 text-sm">Resultado: <strong>{{ $testInput ?: 'Sin clicks' }}</strong></p>
    </div>
    
    <!-- Test Select Simple -->
    <div class="mb-6 p-4 bg-yellow-50 border border-yellow-200 rounded">
        <h3 class="font-semibold mb-3">Test 3: Select HTML Simple</h3>
        <select wire:model.live="selectedFamily" 
                class="w-full border border-gray-300 rounded px-3 py-2">
            <option value="">Selecciona una familia</option>
            @foreach($families as $family)
                <option value="{{ $family->id }}">{{ $family->name }}</option>
            @endforeach
        </select>
        <p class="mt-2 text-sm">Family ID: <strong>{{ $selectedFamily ?: 'vacío' }}</strong></p>
    </div>
    
    <!-- Test Cascading Select -->
    <div class="mb-6 p-4 bg-purple-50 border border-purple-200 rounded">
        <h3 class="font-semibold mb-3">Test 4: Select Cascada</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Select Familia -->
            <div>
                <label class="block text-sm font-medium mb-2">Familia:</label>
                <select wire:model.live="selectedFamily" 
                        class="w-full border border-gray-300 rounded px-3 py-2">
                    <option value="">Selecciona familia</option>
                    @foreach($families as $family)
                        <option value="{{ $family->id }}">{{ $family->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <!-- Select Categoría -->
            <div>
                <label class="block text-sm font-medium mb-2">Categoría:</label>
                <select wire:model.live="selectedCategory"
                        class="w-full border border-gray-300 rounded px-3 py-2"
                        {{ empty($selectedFamily) ? 'disabled' : '' }}>
                    @if(empty($selectedFamily))
                        <option value="">Primero selecciona familia</option>
                    @else
                        <option value="">Selecciona categoría</option>
                        @foreach($this->availableCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        
        <div class="mt-4 p-3 bg-gray-100 rounded">
            <p><strong>Family ID:</strong> {{ $selectedFamily ?: 'vacío' }}</p>
            <p><strong>Category ID:</strong> {{ $selectedCategory ?: 'vacío' }}</p>
            <p><strong>Categorías disponibles:</strong> {{ $this->availableCategories->count() }}</p>
        </div>
    </div>
    
    <!-- JavaScript Debug Info -->
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded">
        <h3 class="font-semibold mb-3">Debug JavaScript</h3>
        <button onclick="checkLivewire()" class="bg-red-500 text-white px-4 py-2 rounded mr-2">
            Check Livewire Status
        </button>
        <button onclick="console.log('Manual log test')" class="bg-gray-500 text-white px-4 py-2 rounded">
            Test Console
        </button>
        <div id="debug-output" class="mt-3 p-2 bg-white rounded border text-sm font-mono"></div>
    </div>
</div>

<script>
function checkLivewire() {
    const output = document.getElementById('debug-output');
    let info = '';
    
    // Check Livewire
    if (typeof window.Livewire !== 'undefined') {
        info += '✅ Livewire loaded\n';
        info += `Version: ${window.Livewire.version || 'unknown'}\n`;
        
        // Try to get component
        try {
            const component = window.Livewire.first();
            if (component) {
                info += '✅ Component found\n';
                info += `Component ID: ${component.id}\n`;
            } else {
                info += '❌ No component found\n';
            }
        } catch (e) {
            info += `❌ Error getting component: ${e.message}\n`;
        }
    } else {
        info += '❌ Livewire NOT loaded\n';
    }
    
    // Check Alpine
    if (typeof window.Alpine !== 'undefined') {
        info += '✅ Alpine.js loaded\n';
    } else {
        info += '⚠️ Alpine.js not loaded\n';
    }
    
    // Check console for errors
    info += '\n📝 Check browser console for errors\n';
    info += '📝 Check Network tab for AJAX requests\n';
    
    output.textContent = info;
    console.log('Livewire Debug:', info);
}

// Auto-check on load
document.addEventListener('DOMContentLoaded', function() {
    console.log('=== Page Loaded ===');
    setTimeout(checkLivewire, 1000);
    
    // Monitor selects manually
    document.addEventListener('change', function(e) {
        if (e.target.matches('select[wire\\:model\\.live]')) {
            console.log('Select changed:', e.target.getAttribute('wire:model.live'), '=', e.target.value);
        }
    });
});
</script>