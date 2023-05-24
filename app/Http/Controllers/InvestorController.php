<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Investor::orderBy('first_name','DESC')->orderBy('last_name','DESC')->paginate(10);

        return view('admin.investors.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.investors.create');
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
            'nic_front' => 'file|mimes:jpeg,png|max:2048',
            'nic_back' => 'file|mimes:jpeg,png|max:2048',
            'business_doc' => 'file|mimes:pdf,doc,docx|max:2048',
        ]);

        $imageStorage = public_path('images/investors/nic');
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
                
            $docStorage = public_path('images/investors/business_doc');
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
        
        $customerAdded = Investor::create($data);
        
        return redirect()->route('investors.index')->with('success','Investor created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function show(Investor $investor)
    {
        if (!empty($investor)) {

            $data = [
                'investor' => $investor
            ];
            return view('admin.investors.show', $data);

        } else {
            return Redirect::to('investors');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function edit(Investor $investor)
    {
        // $investor = Investor::find($investor->id);
    
        return view('admin.investors.edit',compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investor $investor)
    {       
        
        $this->validate($request, [
            'level' => 'required',
            'first_name' => 'required|regex:/^[\pL\s]+$/u',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'cnic' => 'required|string|min:13|max:15|unique:investors,cnic,'.$investor->id,
            'email' => 'email|unique:investors,email,'.$investor->id,
            'phone' => 'required|digits_between:10,15|unique:investors,phone,'.$investor->id,
            'mobile' => 'digits_between:10,15|unique:investors,mobile,'.$investor->id,
            'joining_date' => 'required', //|before_or_equal:dated
            'address' => 'required',
            'branch_name' => 'string|min:5|max:100',
            'branch_code' => 'digits_between:5,20',
            'account_title' => 'string|min:5|max:100',
            'account_number' => 'digits_between:5,50',
            // 'nic_front' => 'file|mimes:jpeg,png|max:2048',
            // 'nic_back' => 'file|mimes:jpeg,png|max:2048',
        ]);
        
        $imageStorage = public_path('images/investors/nic');
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
                
            $docStorage = public_path('images/investors/business_doc');
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
            'joining_date' => $request->joining_date,
            'address' => $request->address,
            'picture' => $request->picture,
            'branch_name' => $request->branch_name,
            'branch_code' => $request->branch_code,
            'account_title' => $request->account_title,
            'account_number' => $request->account_number,
            'business_doc' => isset($docNewName) ? $docNewName : $investor->business_doc,
            'cnic_front' => isset($frontNewName) ? $frontNewName : $investor->cnic_front,
            'cnic_back' => isset($backNewName) ? $backNewName : $investor->cnic_back,
        ];

        $investorUpdated = Investor::find($investor->id)->update($data);
        
        return redirect()->route('investors.index')->with('success','Investor updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investor  $investor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investor $investor)
    {
        dd('aa');
        Investor::find($investor->id)->delete();
        return redirect()->route('investors.index')->with('success','User deleted successfully');
    }
}
