<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Donation::with(['User'])
        ->orderBy('dated', 'DESC')
        ->paginate(10);

        return view('admin.donations.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('status', 1)->where('user_type', 2)->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();

        return view('admin.donations.create', compact('users'));
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
            'amount' => 'required',
            'user_id' => 'required',
            'date' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'dated' => isset($request->date) ? $request->date : now(),
            'amount' => $request->amount,
            'user_id' => $request->user_id,
            'detail' => $request->detail
        ];

        $donationAdded = Donation::create($data);

        return redirect()->route('donations.index')->with('success','Donation created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function show(Donation $donation)
    {
        if (!empty($donation)) {

            $data = [
                'donation' => $donation
            ];
            return view('admin.donations.show', $data);

        } else {
            return Redirect::to('doantions');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function edit(Donation $donation)
    {
        $donors = User::where('status', 1)->where('user_type', 2)->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();

        return view('admin.donations.edit', compact('donation', 'donors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {


        $this->validate($request, [
            'amount' => 'required',
            'user_id' => 'required',
            'date' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : $donation->status,
            'dated' => isset($request->dated) ? $request->dated : $donation->dated,
            'amount' => $request->amount,
            'user_id' => $request->user_id,
            'detail' => $request->detail
        ];

        $donationUpdated = Donation::find($donation->id)->update($data);

        return redirect()->route('donations.index')->with('success','Donation updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Donation  $donation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        dd('aa');
        Donation::find($donation->id)->delete();
        return redirect()->route('donations.index')->with('success','User deleted successfully');
    }
}
