<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->paginate(10);

        return view('admin.customers.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
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
            // 'status' => 'required',
            'level' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'cnic' => 'required|string|min:13|max:15|unique:customers',
            'email' => 'email|unique:customers',
            'phone' => 'required|min:11|max:18|unique:customers',
            'mobile' => 'min:10|max:15|unique:customers',
            'zipcode' => 'required|min:4|max:15',
            // 'phone' => 'required|unique:customers|regex:/(01)[0-9]{9}/',
            // 'mobile' => 'unique:customers|regex:/(01)[0-9]{9}/',
            'joining_date' => 'required',
            'address' => 'required',
            'branch_name' => 'string|min:5|max:100',
            'branch_code' => 'digits_between:5,20',
            'account_title' => 'string|min:5|max:100',
            'account_number' => 'digits_between:5,50',
            'nic_front' => 'file|mimes:jpeg,png|max:2048',
            'nic_back' => 'file|mimes:jpeg,png|max:2048',
            'business_doc' => 'file|mimes:pdf,doc,docx|max:2048',

            ]);

            $imageStorage = public_path('images/customers/nic');
            $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
            
            if(isset($request->nic_front)) {
                $front = $request->nic_front;
                $frontExt = $front->getClientOriginalExtension();

                if(in_array($frontExt, $imageExt)) {
                    $frontNewName = $request->cnic.'_front.'.$frontExt;
                    $front->move($imageStorage, $frontNewName); // Move File
                }
            }
            
            if(isset($request->nic_back)) {
                $back = $request->nic_back;
                $backExt = $back->getClientOriginalExtension();

                if(in_array($backExt, $imageExt)) {
                    $backNewName = $request->cnic.'_back.'.$backExt;
                    $back->move($imageStorage, $backNewName); // Move File
                }
            }
            
            if(isset($request->business_doc)) {
                
                $docStorage = public_path('images/customers/business_doc');
                $docExt = array('pdf', 'doc', 'docx');
                
                $doc = $request->business_doc;
                $docExt = $doc->getClientOriginalExtension();

                // if(in_array($backExt, $docExt)) {
                    $docNewName = $request->cnic.'_doc.'.$docExt;
                    $doc->move($docStorage, $docNewName); // Move File
                // }
            }
            
            $data = [
                'status' => $request->status == 'on' ? 1 : 0,
                'level' => isset($request->level) ? $request->level : 1,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'cnic' => $request->cnic,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobile' => $request->mobile,
                'zipcode' => $request->zipcode,
                'joining_date' => $request->joining_date,
                'address' => $request->address,
                'picture' => $request->picture,
                'branch_name' => $request->branch_name,
                'branch_code' => $request->branch_code,
                'account_title' => $request->account_title,
                'account_number' => $request->account_number,
                'business_doc' => isset($docNewName) ? $docNewName : null,
                'cnic_front' => isset($frontNewName) ? $frontNewName : null,
                'cnic_back' => isset($backNewName) ? $backNewName : null,
            ];
            $customerAdded = Customer::create($data);

        return redirect()->route('customers.index')->with('success','Customer created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        if (!empty($customer)) {

            $data = [
                'customer' => $customer
            ];
            return view('admin.customers.show', $data);

        } else {
            return Redirect::to('customers');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $customer = Customer::find($customer->id);

        return view('admin.customers.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {

        $this->validate($request, [
            // 'status' => 'required',
            'level' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'cnic' => 'required|string|min:13|max:15|unique:customers,cnic,'.$customer->id,
            'email' => 'email|unique:customers,email,'.$customer->id,
            'phone' => 'required|unique:customers,phone,'.$customer->id,
            'mobile' => 'unique:customers,mobile,'.$customer->id,
            'zipcode' => 'required|min:4|max:15',
            'joining_date' => 'required',
            'address' => 'required',
            'branch_name' => 'string|min:5|max:100',
            'branch_code' => 'digits_between:5,20',
            'account_title' => 'string|min:5|max:100',
            'account_number' => 'digits_between:5,50',
            // 'nic_front' => 'file|mimes:jpeg,png|max:2048',
            // 'nic_back' => 'file|mimes:jpeg,png|max:2048',
        ]);

        $imageStorage = public_path('images/customers/nic');
        $imageExt = array('jpeg', 'gif', 'png', 'jpg', 'webp');
        
        if(isset($request->nic_front)) {
            $front = $request->nic_front;
            $frontExt = $front->getClientOriginalExtension();

            if(in_array($frontExt, $imageExt)) {
                $frontNewName = $request->cnic.'_front.'.$frontExt;
                $front->move($imageStorage, $frontNewName); // Move File
            }
        }
        
        if(isset($request->nic_back)) {
            $back = $request->nic_back;
            $backExt = $back->getClientOriginalExtension();

            if(in_array($backExt, $imageExt)) {
                $backNewName = $request->cnic.'_back.'.$backExt;
                $back->move($imageStorage, $backNewName); // Move File
            }
        }
        
        if(isset($request->business_doc)) {
                
            $docStorage = public_path('images/customers/business_doc');
            $docExt = array('pdf', 'doc', 'docx');
            
            $doc = $request->business_doc;
            $docExt = $doc->getClientOriginalExtension();

            // if(in_array($backExt, $docExt)) {
                $docNewName = $request->cnic.'_doc.'.$docExt;
                $doc->move($docStorage, $docNewName); // Move File
            // }
        }
    
        $data = [
            'status' => $request->status == 'on' ? 1 : 0,
            'level' => isset($request->level) ? $request->level : 1,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'cnic' => $request->cnic,
            'email' => $request->email,
            'phone' => $request->phone,
            'mobile' => $request->mobile,
            'zipcode' => $request->zipcode,
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'picture' => $request->picture,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
            'business_doc' => isset($docNewName) ? $docNewName : $customer->business_doc,
            'cnic_front' => isset($frontNewName) ? $frontNewName : $customer->cnic_front,
            'cnic_back' => isset($backNewName) ? $backNewName : $customer->cnic_back,
        ];

        $customerUpdated = Customer::find($customer->id)->update($data);

        return redirect()->route('customers.index')->with('success','Customer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        dd('aa');
        Customer::find($customer->id)->delete();
        return redirect()->route('customers.index')
                        ->with('success','User deleted successfully');
    }
}
