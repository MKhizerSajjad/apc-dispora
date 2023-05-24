<?php

namespace App\Http\Controllers;

use App\Models\ProductTypes;
use Illuminate\Http\Request;

class ProductTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ProductTypes::orderBy('name','DESC')->paginate(10);
        return view('admin.product-types.index', compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        request()->validate([
            'name' => 'required|string|min:3|max:50|unique:product_types',
        ]);
          
          
        $data = [
            'name' => $request->name,
            'detail' => $request->detail,
        ];

        $productType = ProductTypes::create($data);

        return redirect()->route('product-types.index')
            ->with('success', 'Product Type created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTypes $productTypes)
    {
        return view('admin.product-types.show', compact('productType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTypes $productTypes, $id)
    {
        $productTypes = ProductTypes::where('id', $id)->first();
        return view('admin.product-types.edit', compact('productTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTypes $productTypes, $id)
    {
        $validatedData = $request->validate([
            'name' => "required|unique:product_types,name,$productTypes->id|max:255",
        ]);

        $data = [
            'name' => $request->name,
            'detail' => $request->detail,
        ];

        $update = ProductTypes::find($id)->update($data);

        return redirect()->route('product-types.index')
            ->with('success', 'Product Type updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductTypes  $productTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTypes $productTypes)
    {
        dd('a');
        $productTypes->delete();

        return redirect()->route('admin.product-types.index')
            ->with('success', 'Product type deleted successfully.');
    }
}
