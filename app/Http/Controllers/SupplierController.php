<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->paginate(10);

        return view('admin.suppliers.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'level' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'cnic' => 'required|string|min:13|max:15|unique:investors',
            'email' => 'email|unique:investors',
            'phone' => 'required|digits_between:10,15|unique:investors',
            'mobile' => 'digits_between:10,15|unique:investors',
            'joining_date' => 'required', //before_or_equal:dated
            'address' => 'required',
            'branch_name' => 'string|min:5|max:100',
            'branch_code' => 'digits_between:5,20',
            'account_title' => 'string|min:5|max:100',
            'account_number' => 'digits_between:5,50',
        ]);
            
        $data = [
            'status' => $request->status == 'on' ? 1 : 0,
            'level' => isset($request->level) ? $request->level : 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cnic' => $request->cnic,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'picture' => $request->picture,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
        ];
        
        $customerAdded = Supplier::create($data);
        
        return redirect()->route('suppliers.index')->with('success','Supplier created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        if (!empty($supplier)) {

            $data = [
                'supplier' => $supplier
            ];
            return view('admin.suppliers.show', $data);

        } else {
            return Redirect::to('suppliers');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $supplier = Supplier::find($supplier->id);
    
        return view('admin.suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {       
        
        $this->validate($request, [
            'level' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'cnic' => 'required|string|min:13|max:15|unique:investors,cnic,'.$supplier->id,
            'email' => 'email|unique:suppliers,email,'.$supplier->id,
            'phone' => 'required|digits_between:10,15|unique:suppliers,phone,'.$supplier->id,
            'mobile' => 'digits_between:10,15|unique:suppliers,mobile,'.$supplier->id,
            'joining_date' => 'required', //|before_or_equal:dated
            'address' => 'required',
            'branch_name' => 'string|min:5|max:100',
            'branch_code' => 'digits_between:5,20',
            'account_title' => 'string|min:5|max:100',
            'account_number' => 'digits_between:5,50',
        ]);
            
        $data = [
            'status' => $request->status == 'on' ? 1 : 0,
            'level' => isset($request->level) ? $request->level : 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cnic' => $request->cnic,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'picture' => $request->picture,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
        ];

        $supplierUpdated = Supplier::find($supplier->id)->update($data);
        
        return redirect()->route('suppliers.index')->with('success','Supplier updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        dd('aa');
        Supplier::find($supplier->id)->delete();
        return redirect()->route('suppliers.index')->with('success','User deleted successfully');
    }
}
