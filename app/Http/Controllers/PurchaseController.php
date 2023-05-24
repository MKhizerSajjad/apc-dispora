<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Investor;
use App\Models\Investment;
use App\Models\PurchaseProducts;
use App\Models\PurchaseInvestment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $purchases = Purchase::with('Supplier')->orderBy('dated','DESC');

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
            $purchases = $purchases->where('status', $status);
        }

        // Filter by invoice
        if ($request->has('invoice') && $request->invoice != '') {
            $invoice = $request->invoice;
            $purchases = $purchases->where('invoice_no', 'like', '%'.$invoice.'%');
        }

        // Filter by due date range
        if ($request->has('from') && $request->from && $request->has('to') && $request->to) {
            $from = $request->from;
            $to = $request->to;
            $purchases = $purchases->whereBetween('dated', [$from, $to]);
        }

        // Filter by customer
        if ($request->has('supplier') && $request->supplier) {
            $supplier = $request->supplier;
            $purchases = $purchases->where('supplier_id', $supplier);
        }
        
        $data = $purchases->paginate(10);

        $filters = $request->all();

        $suppliers = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();

        return view('admin.purchases.index', compact('data', 'filters', 'suppliers'))->with('searchParams', $request->query());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $products = Product::orderBy('name','DESC')->where('status', '1')->get();
        $investors = Investor::where('status', '1')->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();
        return view('admin.purchases.create', compact('suppliers', 'products', 'investors'));
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
            'supplier_id' => 'required',
            'total_amount' => 'required',
            'product_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
            // 'total_investment' => 'required',
            'total_investment' => 'required|same:total_amount',
        ]);

        $invoiceNumber = 'VOL-' . date('Ymd') . '-' . str_pad(Purchase::count() + 1, 4, '0', STR_PAD_LEFT);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'dated' => date('Y-m-d'),
            'invoice_no' => $invoiceNumber,
            'total_amount' => $request->total_amount,
            'paid_amount' => isset($request->paid_amount) ? $request->paid_amount : 0,
            'supplier_id' => $request->supplier_id,
        ];

        $purchaseAdded = Purchase::create($data);

        $purchaseProducts = [];

        for ($i = 0; $i < count($request->product_id); $i++) {
            $purchaseProducts[] = [
                'purchase_id' => $purchaseAdded->id,
                'product_id' => $request->product_id[$i],
                'unit_price' => $request->unit_price[$i],
                'quantity' => $request->quantity[$i],
            ];
        }

        // dd($purchaseProducts);
        // $purchaseAdded = PurchaseProducts::upsert($purchaseProducts, ['purchase_id', 'supplier_id', 'product_id']);
        // $data, ['supplier_id', 'product_id'], $fieldsToUpdate
        PurchaseProducts::insert($purchaseProducts);


        $investors = [];

        for ($i = 0; $i < count($request->investor_id); $i++) {
            $investors[] = [
                'amount' => $request->invest_amount[$i],
                'profit_percentage' => $request->profit_percentage[$i],
                'purchase_id' => $purchaseAdded->id,
                'investment_id' => $request->investment_id[$i],
                'investor_id' => $request->investor_id[$i],
            ];
        }

        PurchaseInvestment::insert($investors);

        return redirect()->route('purchases.index')->with('success','Purchase created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        // dd($purchase->products);
        if (!empty($purchase)) {

            $data = [
                'purchase' => $purchase
            ];
            return view('admin.purchases.show', $data);

        } else {
            return Redirect::to('purchases');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        
        $suppliers = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $investors = Investor::where('status', '1')->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();
        $products = Product::orderBy('name','DESC')->where('status', '1')->get();
        $investments = Investment::where('status', '1')->orderBy('dated','DESC')->get();
        $purchaseProducts = PurchaseProducts::orderBy('product_id')->where('purchase_id', $purchase->id)->get();
        $purchaseInvestments = PurchaseInvestment::orderBy('purchase_id')->where('purchase_id', $purchase->id)->get();

        return view('admin.purchases.edit',compact('purchase', 'suppliers', 'products', 'investors', 'investments', 'purchaseProducts', 'purchaseInvestments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        $this->validate($request, [
            'supplier_id' => 'required',
            'total_amount' => 'required',
            'product_id' => 'required',
            'unit_price' => 'required',
            'quantity' => 'required',
            // 'total_investment' => 'required',
            'total_investment' => 'required|same:total_amount',
        ]);

        $data = [
            'status' => isset($request->status) ? $request->status : 1,
            'dated' => date('Y-m-d'),
            'total_amount' => $request->total_amount,
            'paid_amount' => isset($request->paid_amount) ? $request->paid_amount : 0,
            'supplier_id' => $request->supplier_id,
        ];

        $purchaseAdded = Purchase::find($purchase->id)->update($data);

        for ($i = 0; $i < count($request->product_id); $i++) {
            PurchaseProducts::updateOrCreate(
                [
                    'purchase_id' => $purchase->id,
                    'product_id' => $request->product_id[$i]
                ],
                [
                    'unit_price' => $request->unit_price[$i],
                    'quantity' => $request->quantity[$i]
                ]
            );
        }

        for ($i = 0; $i < count($request->investor_id); $i++) {
            PurchaseInvestment::updateOrCreate(
                [
                    'purchase_id' => $purchase->id,
                    'investor_id' => $request->investor_id[$i],
                ],
                [
                    'investment_id' => $request->investment_id[$i],
                    'amount' => $request->invest_amount[$i],
                    'profit_percentage' => $request->profit_percentage[$i]
                ]
            );
        }
        
        // $purchaseProducts = [];

        // for ($i = 0; $i < count($request->product_id); $i++) {
        //     $purchaseProducts[] = [
        //         'purchase_id' => $purchase->id,
        //         'product_id' => $request->product_id[$i],
        //         'unit_price' => $request->unit_price[$i],
        //         'quantity' => $request->quantity[$i],
        //     ];
        // }

        // PurchaseProducts::updateOrCreate($purchaseProducts);



        // $purchaseProducts = [];

        // for ($i = 0; $i < count($request->product_id); $i++) {
        //     $purchaseProducts[] = [
        //         // 'id' => $request->product_row_id[$i], // add the row id to the array
        //         'purchase_id' => $purchase->id,
        //         'product_id' => $request->product_id[$i],
        //         'unit_price' => $request->unit_price[$i],
        //         'quantity' => $request->quantity[$i],
        //     ];
        // }

        // foreach ($purchaseProducts as $product) {
        //     // dd($product['product_id']);
        //     PurchaseProducts::updateOrCreate(['id' => $product['product_id']], $product);
        // }

        return redirect()->route('purchases.index')->with('success','Purchase updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        dd('aa');
        Purchase::find($purchase->id)->delete();
        return redirect()->route('purchases.index')->with('success','Purchase deleted successfully');
    }

    public function invoice(Request $request, Purchase $purchase)
    {
        $data = Purchase::find($request->id);
        $purchaseProducts = PurchaseProducts::orderBy('product_id')->where('purchase_id', $request->id)->get();
        // $purchaseInvestments = PurchaseInvestment::orderBy('purchase_id')->where('purchase_id', $request->id)->get();

        return view('admin.purchases.invoice',compact('data', 'purchaseProducts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function investment(Purchase $purchase)
    {

        $investors = Investor::where('status', '1')->orderBy('first_name','DESC')->orderBy('last_name','DESC')->get();

        return view('admin.purchases.investment', compact('investors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function investmentStore(Request $request, Purchase $purchase)
    {

        dd($request);

        // $this->validate($request, [
        //     'cnic' => 'required|unique:investors',
        // ]);

        $purchaseProducts = [];

        for ($i = 0; $i < count($request->product_id); $i++) {
            $purchaseProducts[] = [
                'purchase_id' => $purchase->id,
                'product_id' => $request->product_id[$i],
                'unit_price' => $request->unit_price[$i],
                'quantity' => $request->quantity[$i],
            ];
        }

        // dd($purchaseProducts);
        // $purchaseAdded = PurchaseProducts::upsert($purchaseProducts, ['purchase_id', 'supplier_id', 'product_id']);
        // $data, ['supplier_id', 'product_id'], $fieldsToUpdate
        PurchaseProducts::insert($purchaseProducts);

        return redirect()->route('purchases.index')->with('success','Purchase created successfully');
    }


    public function investorInvestments(Request $request)
    {
        $investorId = $request->input('investor_id');
        $investments = Investment::where('investor_id', $investorId)->pluck('name', 'id');
        $options = '<option value="">Select Investment</option>';
        foreach ($investments as $id => $name) {
          $options .= '<option value="' . $id . '">' . $name . '</option>';
        }
        return $options;
    }

}
