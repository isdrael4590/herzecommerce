
import './bootstrap';

// Solo cargar Alpine si no está ya definido (evita conflictos con CDN)
if (!window.Alpine && !document.querySelector('script[src*="alpinejs"]')) {
    // Solo para layouts que no cargan Alpine desde CDN
    document.addEventListener('DOMContentLoaded', function () {
        import('alpinejs').then((Alpine) => {
            window.Alpine = Alpine.default;
            Alpine.default.start();
            console.log('Alpine loaded from Vite/app.js');
        });
    });
} else {
    console.log('App.js loaded - Alpine will be loaded from CDN or already exists');
}