<?php


namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Product\Models\Subcategory;
use Modules\Product\Models\Category;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::orderBy('id', 'desc')->with('category.family')->paginate(10);

        return view('admin.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //$categories = Category::all();
        //return view('admin.subcategories.create', compact('categories'));
        return view('admin.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required',
        ]);

        Subcategory::create($request->all());
            session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategory created successfully',
            'text' => 'Subcategory has been created.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(subcategory $subcategory)
    {
        return view('admin.subcategories.edit', compact('subcategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, subcategory $subcategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(subcategory $subcategory)
    {
        if ($subcategory->products()->count()) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Cannot delete subcategory',
                'text' => 'The subcategory cannot be deleted because it has associated products.',
                'showConfirmButton' => true,
            ]);
            return redirect()->route('admin.subcategories.index');
        }
        $subcategory->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Subcategory deleted successfully',
            'text' => 'Subcategory has been deleted.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);
        return redirect()->route('admin.subcategories.index');
    }
}
