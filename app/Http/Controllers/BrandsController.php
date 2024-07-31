<?php

namespace App\Http\Controllers;

use App\Models\Brand;

use Illuminate\Http\Request;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderby('created_at', 'DESC')->get();
        return view('brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(view: 'brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:50|unique:brands'
        ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->save();

        flash(message: 'Brand created successfully')->success();
        return back();
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::findOrFail($id);
        return view('brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validation
        $validatedData = $request->validate([
            'name' => 'required|min:2|max:50|unique:brands,name,' . $id
        ]);
    
        $brand = Brand::findOrFail($id);
        $brand->name = $request->name;
        $brand->save();
    
        flash(message: 'Brand updated successfully')->info();
        return redirect()->route(route: 'brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        flash(message: 'Brand deleted successfully')->warning();
        return redirect()->route(route: 'brands.index');
    }
}
