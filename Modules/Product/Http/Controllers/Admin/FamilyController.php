<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Family;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $families = Family::orderBy('id', 'desc')->paginate(10);
        return view('admin.families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.families.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Family::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Family created successfully',
            'text' => 'Family has been created.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);

        return redirect()->route('admin.families.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Family $family)
    {
        return view('admin.families.show', compact('family'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Family $family)
    {
        return view('admin.families.edit', compact('family'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Family $family)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);


        $family->update($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Family updated successfully',
            'text' => 'Family has been updated.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);


        return redirect()->route('admin.families.index', $family);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Family $family)
    {
        if ($family->categories->count() > 0) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error',
                'text' => 'Familia no puede ser eliminada porque tiene categorías asociadas',
                'showConfirmButton' => true,
            ]);
            return redirect()->route('admin.families.index');
        }
        $family->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Familia eliminada con éxito',
            'text' => 'La familia ha sido eliminada.',
            'showConfirmButton' => false,
            'timer' => 1500
        ]);
        return redirect()->route('admin.families.index')->with('success', 'Familia eliminada con éxito.');
    }
}
