<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Category;
use Modules\Product\Models\Family;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::orderBy('id', 'DESC')->with('family')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $families = Family::all();
        return view('admin.categories.create', compact('families'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'family_id' => 'required|exists:families,id',
        ]);

        Category::create($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Category created successfully',
            'text' => 'Category has been created.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $families = Family::all();
        return view('admin.categories.edit', compact('category', 'families'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'family_id' => 'required|exists:families,id',
        ]);

        $category->update($request->all());
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Category updated successfully',
            'text' => 'Category has been updated.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Verificar si la categoría tiene subcategorías asociadas
        if ($category->subcategories->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Categoría no puede ser eliminada porque tiene subcategorías asociadas',
                'showConfirmButton' => true,
            ]);
            return redirect()->route('admin.categories.index');
        }

        $category->delete();

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Categoría eliminada con éxito',
            'text' => 'La categoría ha sido eliminada.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.categories.index');
    }
}
