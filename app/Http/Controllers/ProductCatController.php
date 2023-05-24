<?php

namespace App\Http\Controllers;

use App\Models\ProductCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = ProductCat::orderBy('name','DESC')->paginate(10);

        return view('admin.product-cats.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = ProductCat::orderBy('name','DESC')->select('id', 'name')->get();
        return view('admin.product-cats.create', compact('cats'));
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
            'name' => 'required|string|min:3|max:50|unique:product_cats',
        ]);
          
        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'detail' => $request->detail,
        ];
        
        $productCatAdded = ProductCat::create($data);
    
        return redirect()->route('product-cats.index')
                        ->with('success','Product category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function show(ProductCat $productCat)
    {
        return view('product-cats.show',compact('productCat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductCat $productCat)
    {
        $cats = ProductCat::orderBy('name','DESC')->select('id', 'name')->where('id', '!=', $productCat->id)->get();
        return view('admin.product-cats.edit',compact('productCat', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductCat $productCat)
    {
        request()->validate([
            'name' => 'required|string|min:3|max:50',
       ]);
   
        $data = [
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'detail' => $request->detail,
        ];
        
        $productCatUpdated = ProductCat::find($productCat->id)->update($data);
   
        return redirect()->route('product-cats.index')
                       ->with('success','Product category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductCat  $productCat
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCat $productCat)
    {
        dd('aa');
        productCat::find($productCat->id)->delete();
        return redirect()->route('investors.index')->with('success','User deleted successfully');
    }
}
