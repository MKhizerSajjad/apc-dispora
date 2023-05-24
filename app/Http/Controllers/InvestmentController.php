<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Investment::with(['Investor', 'purchaseInvestments' => function ($query) {
            $query->selectRaw('SUM(amount) as total_amount, investment_id')
                  ->groupBy('investment_id');
        }])
        ->orderBy('dated', 'DESC')
        ->paginate(10);

        return view('admin.investments.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $investors = Investor::where('status', '1')->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();

        return view('admin.investments.create', compact('investors'));
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
            'investor_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'dated' => isset($request->dated) ? $request->dated : now(),
            'amount' => $request->amount,
            'investor_id' => $request->investor_id,
            'detail' => $request->detail
        ];

        $investmentAdded = Investment::create($data);

        return redirect()->route('investments.index')->with('success','Investment created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function show(Investment $investment)
    {
        if (!empty($investment)) {

            $data = [
                'investment' => $investment
            ];
            return view('admin.investments.show', $data);

        } else {
            return Redirect::to('investments');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function edit(Investment $investment)
    {
        $investors = Investor::where('status', '1')->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();

        return view('admin.investments.edit', compact('investment', 'investors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investment $investment)
    {


        $this->validate($request, [
            'amount' => 'required',
            'investor_id' => 'required',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'dated' => isset($request->dated) ? $request->dated : now(),
            'amount' => $request->amount,
            'investor_id' => $request->investor_id,
            'detail' => $request->detail
        ];

        $investmentUpdated = Investment::find($investment->id)->update($data);

        return redirect()->route('investments.index')->with('success','Investment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Investment  $investment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investment $investment)
    {
        dd('aa');
        Investment::find($investment->id)->delete();
        return redirect()->route('investments.index')->with('success','User deleted successfully');
    }
}
