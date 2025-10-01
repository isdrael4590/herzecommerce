<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            // 1. CARGAR EL ARCHIVO ADMIN ORIGINAL (routes/admin.php)
            $originalAdminPath = base_path('routes/admin.php');
            if (file_exists($originalAdminPath)) {
                Route::middleware(['web', 'auth'])
                    ->prefix('admin')
                    ->name('admin.')
                    ->group($originalAdminPath);
            }

            // 2. CARGAR RUTAS ADMIN DE MÓDULOS ESPECÍFICOS
            $modulesWithAdmin = [ 'Product',];

            foreach ($modulesWithAdmin as $module) {
                $moduleAdminPath = base_path("Modules/{$module}/routes/admin.php");

                if (file_exists($moduleAdminPath)) {
                    Route::middleware(['web', 'auth'])
                        ->prefix('admin')
                        ->name('admin.')
                        ->group($moduleAdminPath);
                }
            }
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
