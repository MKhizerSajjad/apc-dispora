<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCat;
use App\Models\ProductTypes;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // function __construct()
    // {
    //      $this->middleware('permission:product-list|product-create|product-edit|product-delete', ['only' => ['index','show']]);
    //      $this->middleware('permission:product-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:product-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:product-delete', ['only' => ['destroy']]);
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Product::orderBy('name','DESC')->paginate(10);

        return view('admin.products.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $types = ProductTypes::orderBy('name','DESC')->select('id', 'name')->where('status', 1)->get();
        $cats = ProductCat::orderBy('name','DESC')->select('id', 'name')->where('status', 1)->get();
        return view('admin.products.create', compact('cats', 'types'));
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
            'name' => 'required|string|min:3|max:100',
            'sku' => 'required|string|min:3|max:100|unique:products',
            // 'size_id' => 'required',
            // 'color_id' => 'required',
            // 'gender_id' => 'required',
            'type_id' => 'required',
            // 'cat_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            // 'size_id' => $request->size_id,
            // 'color_id' => $request->color_id,
            // 'gender_id' => $request->gender_id,
            'type_id' => $request->type_id,
            'cat_id' => $request->cat_id,
            'sub_cat_id' => $request->sub_cat_id,
            'detail' => $request->detail,
        ];

        $productCatAdded = Product::create($data);

        if($request->request_type == 'ajax') {

            $products = Product::orderBy('name','DESC')->where('status', '1')->get();
            return $products;

        } else {

            return redirect()->route('products.index')
                            ->with('success','Product created successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        dd($product->purchase);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $types = ProductTypes::orderBy('name','DESC')->select('id', 'name')->where('status', 1)->get();
        $cats = ProductCat::orderBy('name','DESC')->get();
        $sub_cats = ProductCat::orderBy('name','DESC')->where([['status', 1], ['parent_id', $product->cat_id]])->get();
        return view('admin.products.edit',compact('types', 'cats', 'sub_cats', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required|string|min:3|max:100',
            'sku' => 'required|string|min:3|max:100|unique:products,sku,'.$product->id,
            // 'size_id' => 'required',
            // 'color_id' => 'required',
            // 'gender_id' => 'required',
            'type_id' => 'required',
            'cat_id' => 'required',
        ]);

        $data = [
            'name' => $request->name,
            'sku' => $request->sku,
            // 'size_id' => $request->size_id,
            // 'color_id' => $request->color_id,
            // 'gender_id' => $request->gender_id,
            'type_id' => $request->type_id,
            'cat_id' => $request->cat_id,
            'sub_cat_id' => $request->sub_cat_id,
            'detail' => $request->detail,
        ];

        $productUpdated = Product::find($product->id)->update($data);

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // $product->delete();

        // return redirect()->route('products.index')
        //                 ->with('success','Product deleted successfully');
    }
}
