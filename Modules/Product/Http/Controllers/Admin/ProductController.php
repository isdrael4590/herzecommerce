<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Modules\Product\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // abort_if(Gate::denies('access_product'), 403);
        $products = Product::orderBy('id', 'desc')->paginate();
        return view('product::admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_if(!Gate::check('access_product') || !Gate::check('create'), 403);
        return view('product::admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Este método lo maneja Livewire, puede quedar vacío o redirigir
        return redirect()->route('admin.products.index');
    }

    /**
     * Show the specified resource.
     */
    public function show(Product $product)
    {
        return view('product::admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(Product $product)
{
    return view('product::admin.products.edit', compact('product'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // Este método lo maneja Livewire, puede quedar vacío o redirigir
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            // Eliminar la imagen si existe
            if ($product->image_path) {
                \Storage::disk('public')->delete($product->image_path);
            }
            
            $product->delete();
            
            return redirect()->route('admin.products.index')
                ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.products.index')
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }
}