<?php

namespace App\Http\Controllers;

use Route;
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
        $type = $request->query('type');
        if($type == 'sub') {
            $data = ProductCat::orderBy('name','DESC')->where('parent_id', '!=', null)->paginate(10);
        } else {
            $data = ProductCat::orderBy('name','DESC')->where('parent_id', null)->paginate(10);
        }

        return view('admin.product-cats.index',compact('data', 'type'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $type = $request->query('type');
        $cats = ProductCat::orderBy('name','DESC')->select('id', 'name')->get();
        return view('admin.product-cats.create', compact('cats', 'type'));
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
            // 'image' => 'required',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'dimensions:max_width=4096,max_height=4096'
        ]);

        // dd($request->hasFile('image'));
        // // Handle file upload
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $imagePath = 'images/product_categories' . $imageName;
        // } else {
        //     $imagePath = null;
        // }

        $data = [
            'name' => $request->name,
            'parent_id' => isset($request->parent_id) ? $request->parent_id : null,
            // 'image' => $imagePath,
            'detail' => $request->detail,
        ];

        $productCatAdded = ProductCat::create($data);

        $type = isset($request->parent_id) ? 'sub' : 'main';

        return redirect()->route('product-cats.index', ['type' => $type])
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
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload
        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $imageName = time() . '.' . $image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $imageName);
        //     $imagePath = 'images/' . $imageName;
        // } else {
        //     $imagePath = null;
        // }

        $data = [
            'name' => $request->name,
            'parent_id' => isset($request->parent_id) ? $request->parent_id : null,
            // 'image' => $imagePath,
            'detail' => $request->detail,
        ];

        $productCatUpdated = ProductCat::find($productCat->id)->update($data);
        
        $type = isset($request->parent_id) ? 'sub' : 'main';

        return redirect()->route('product-cats.index', ['type' => $type])
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
