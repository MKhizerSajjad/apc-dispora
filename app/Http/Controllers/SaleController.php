<?php
namespace App\Http\Controllers;

use DB;
use App\Models\Sale;
use App\Models\Product;
use App\Models\ProductCat;
use App\Models\Customer;
use App\Models\SaleProducts;
use App\Models\SaleRecovery;
use App\Models\PurchaseProducts;
use App\Models\PurchaseInvestment;
use App\Models\PurchaseInvestmentReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $route = Route::current()->uri();
        $sales = Sale::with('customer')->orderBy('invoice_no', 'DESC');       

        if($route == 'quotations') {
            $sales = $sales->where('type', 'quotation');
        } else if($route == 'credit-sales') {
            $sales = $sales->where('type', '!=', 'quotation')->where('status', '!=', 1);
        } else {
            $sales = $sales->where('type', '!=', 'quotation')->where('status', 1);
        }

        // Filter by status
        if ($request->has('status') && $request->status != '') {
            $status = $request->status;
            $sales = $sales->where('status', $status);
        }

        // Filter by invoice
        if ($request->has('invoice') && $request->invoice != '') {
            $invoice = $request->invoice;
            $sales = $sales->where('invoice_no', 'like', '%'.$invoice.'%');
        }

        // Filter by due date range
        if ($request->has('from') && $request->from && $request->has('to') && $request->to) {
            $from = $request->from;
            $to = $request->to;
            $sales = $sales->whereBetween('dated', [$from, $to]);
        }

        // Filter by customer
        if ($request->has('customer') && $request->customer) {
            $customer = $request->customer;
            $sales = $sales->where('customer_id', $customer);
        }

        $data = $sales->paginate(10);

        $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();

        $filters = $request->all();
            
        return view('admin.sales.index', compact('data', 'filters', 'customers'))->with('searchParams', $request->query());
    }

    
    // public function creditSales(Request $request)
    // {
    //     $sales = Sale::with('customer')->orderBy('invoice_no', 'DESC')->where('status', '!=', 1);
        
    //     // Filter by status
    //     if ($request->has('status') && $request->status != '') {
    //         $status = $request->status;
    //         $sales = $sales->where('status', $status);
    //     }

    //     // Filter by invoice
    //     if ($request->has('invoice') && $request->invoice != '') {
    //         $invoice = $request->invoice;
    //         $sales = $sales->where('invoice_no', 'like', '%'.$invoice.'%');
    //     }

    //     // Filter by due date range
    //     if ($request->has('from') && $request->from && $request->has('to') && $request->to) {
    //         $from = $request->from;
    //         $to = $request->to;
    //         $sales = $sales->whereBetween('dated', [$from, $to]);
    //     }

    //     // Filter by customer
    //     if ($request->has('customer') && $request->customer) {
    //         $customer = $request->customer;
    //         $sales = $sales->where('customer_id', $customer);
    //     }

    //     $data = $sales->paginate(10);

    //     $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();

    //     $filters = $request->all();
            
    //     return view('admin.sales.index', compact('data', 'filters', 'customers'))->with('searchParams', $request->query());
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = ProductCat::orderBy('name','DESC')->select('id', 'name')->get();
        $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $products = Product::orderBy('name','DESC')->where('status', '1')->get();
        return view('admin.sales.create', compact('customers', 'products', 'cats'));
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
            'customer_id' => 'required',
            // 'due_date' => 'required',
            'total_amount' => 'required|numeric',
            'product_id' => 'required',
            'sale_unit_price' => 'required',
            'quantity' => 'required',
            'paid_amount' => 'numeric|gte:0|lte:total_amount',
        ]);

        // on basis of amount assign status
        if($request->paid_amount == $request->total_amount) {
            $status = 1;
        } else if (($request->paid_amount < $request->total_amount) && ($request->paid_amount > 0)) {
            $status = 2;
        } else {
            $status = 3;
        }

        $invoiceNumber = 'VOL-' . date('Ymd') . '-' . str_pad(Sale::count() + 1, 4, '0', STR_PAD_LEFT);

        $data = [
            'status' => $status,
            'type' => isset($request->type) ? ($request->type) : 'sale',
            'dated' => date('Y-m-d'),
            'due_date' => isset($request->due_date) ? $request->due_date : date('Y-m-d'),
            'invoice_no' => $invoiceNumber,
            'total_amount' => $request->total_amount,
            'paid_amount' => isset($request->paid_amount) ? $request->paid_amount : 0,
            'profit_amount' => isset($request->total_profit) ? $request->total_profit : 0,
            'company_profit' => isset($request->company_profit_percentage) ? $request->company_profit_percentage : 0,
            'investors_profit' => isset($request->company_profit_percentage) ? (100 - $request->company_profit_percentage) : 0,
            'remarks' => isset($request->remarks) ? $request->remarks : '',
            'customer_id' => $request->customer_id,
        ];

        $saleAdded = Sale::create($data);

        $saleProducts = [];

        for ($i = 0; $i < count($request->product_id); $i++) {
            
            $saleProducts[] = [
                'sale_id' => $saleAdded->id,
                'product_id' => $request->product_id[$i],
                'purchase_id' => $request->purchase_id[$i],
                'quantity' => $request->quantity[$i],
                'unit_price' => $request->sale_unit_price[$i],
                // 'company_profit' => $request->profit_percentage[$i], // %
                // 'company_profit' => $request->my_profit[$i], // amount
                // 'investors_profit' => (100 - $request->profit_percentage[$i]), // %
                // 'investors_profit' => $request->investors_profit[$i] //amount
                'created_at' => now()
            ];

            
            if($request->paid_amount > 0) {

                $companyProfitAdded = false;
                if ($companyProfitAdded == false) {
                    
                    $companyProfitAdded = true;

                    $totalProfitPercentage = ($request->total_profit / $request->total_amount) * 100; // Profit percentage from total amount
                    $totalProfitAmount = ($totalProfitPercentage * $request->paid_amount) / 100 ; // proft amount according to now paying and profit percentage-split from total amount
                    $companyProfitAmount = ($totalProfitAmount * $request->company_profit_percentage ) / 100;
                    $investorsProfitAmount = $totalProfitAmount - $companyProfitAmount;
                    
                    $data = [
                        'status' => 1,
                        'dated' => date('Y-m-d'),
                        'amount' => $companyProfitAmount,
                        'sale_id' => $saleAdded->id,
                        'investment_id' => null,
                        'investor_id' => null,
                    ];

                    $amountPaidAdded = PurchaseInvestmentReturn::create($data);
                        
                }

                $investments = PurchaseInvestment::where('purchase_id', $request->purchase_id[$i]);
                $totalInvestmentAmount = $investments->sum('amount');
                $investments = $investments->get();

                foreach($investments as $investment) {
                   $profitSplitPercentage = ($investment->amount / $totalInvestmentAmount) * 100;
                    //    echo $profitSplitPercentage .'--';
                   $profitSplitAmount = round($profitSplitPercentage * $investorsProfitAmount) / 100;
                    //    echo $profitSplitAmount .'<br>';
                   
                    $data = [
                        'status' => 1,
                        'dated' => date('Y-m-d'),
                        'amount' => $profitSplitAmount,
                        'sale_id' => $saleAdded->id,
                        'investment_id' => $investment->investment_id,
                        'investor_id' => $investment->investor_id,
                    ];

                    $amountPaidAdded = PurchaseInvestmentReturn::create($data);
                }
            }
        }

        // dd($saleProducts);
        // $purchaseAdded = SaleProducts::upsert($saleProducts, ['sale_id', 'customer_id', 'product_id']);
        // $data, ['customer_id', 'product_id'], $fieldsToUpdate
        SaleProducts::insert($saleProducts);

        if($request->paid_amount > 0) {
            $data = [
                'dated' => date('Y-m-d'),
                'amount' => $request->paid_amount,
                'fine' => isset($request->fine) ? $request->fine : 0,
                'sale_id' => $saleAdded->id,
                'customer_id' => $request->customer_id,
            ];

            $amountPaidAdded = SaleRecovery::create($data);
        }
    
        $redirectTo = isset($request->type) && $request->type == 'Quotation' ? 'quotations' : 'sales';

        return redirect()->route($redirectTo.'.index')->with('success','Sale created successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        if (!empty($sale)) {

            $data = [
                'sale' => $sale
            ];
            return view('admin.sales.show', $data);

        } else {
            return Redirect::to('sales');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        $saleProducts = SaleProducts::with('product.purchaseProducts')->orderBy('product_id')->where('sale_id', $sale->id)->get();
        $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $products = Product::orderBy('name','DESC')->where('status', '1')->get();

        // dd($saleProducts[0]->product->purchaseProducts);
        return view('admin.sales.edit',compact('sale', 'customers', 'products', 'saleProducts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        $this->validate($request, [
            // 'customer_id' => 'required',
            'total_amount' => 'required|numeric',
            // 'product_id' => 'required',
            'sale_unit_price' => 'required',
            'quantity' => 'required',
            'now_pay' => 'numeric|gte:0|lte:total_amount',
        ]);

        $totalPaid = $request->now_pay + $sale->paid_amount;

        // on basis of amount assign status
        if($totalPaid == $sale->total_amount) {
            $status = 1;
            $type = 'converted_to_sale';
        } else if (($totalPaid < $sale->total_amount) && ($totalPaid > 0)) {
            $status = 2;
            $type = 'converted_to_sale';
        } else {
            $status = 3;
            $type = 'quotation';
        }

        // dd($totalPaid . $sale->paid_amount . $status . $type);
        $data = [
            'status' => $status,
            'type' => $type,
            'due_date' => isset($request->due_date) ? $request->due_date : $sale->due_date,
            'total_amount' => isset($request->total_amount) ? $request->total_amount : $sale->total_amount,
            'paid_amount' => $totalPaid,
            'profit_amount' => isset($request->total_profit) ? $request->total_profit : $sale->total_amount,
            'company_profit' => isset($request->company_profit_percentage) ? $request->company_profit_percentage : $sale->company_profit,
            'investors_profit' => isset($request->company_profit_percentage) ? (100 - $request->company_profit_percentage) : $sale->investors_profit,
            'remarks' => isset($request->remarks) ? $request->remarks : $sale->remarks,
        ];

        $saleAdded = Sale::find($sale->id)->update($data);

        for ($i = 0; $i < count($request->product_id); $i++) {

            SaleProducts::updateOrCreate(
                [
                    'sale_id' => $sale->id,
                    'product_id' => $request->product_id[$i]
                ],
                [
                    'purchase_id' => $request->purchase_id[$i],
                    'quantity' => $request->quantity[$i],
                    'unit_price' => $request->sale_unit_price[$i],
                ]
            );

            if($request->now_pay > 0) {

                $companyProfitUpdated = false;
                if ($companyProfitUpdated == false) {
                    
                    $companyProfitUpdated = true;

                    $totalProfitPercentage = ($request->total_profit / $request->total_amount) * 100; // Profit percentage from total amount
                    $totalProfitAmount = ($totalProfitPercentage * $request->now_pay) / 100 ; // proft amount according to now paying and profit percentage-split from total amount
                    $companyProfitAmount = ($totalProfitAmount * $request->company_profit_percentage ) / 100;
                    $investorsProfitAmount = $totalProfitAmount - $companyProfitAmount;
                    
                    $data = [
                        'status' => 1,
                        'dated' => date('Y-m-d'),
                        'amount' => $companyProfitAmount,
                        'sale_id' => $sale->id,
                        'investment_id' => null,
                        'investor_id' => null,
                    ];

                    $amountPaidAdded = PurchaseInvestmentReturn::create($data);
                        
                }

                $investments = PurchaseInvestment::where('purchase_id', $request->purchase_id[$i]);
                $totalInvestmentAmount = $investments->sum('amount');
                $investments = $investments->get();

                foreach($investments as $investment) {
                   $profitSplitPercentage = ($investment->amount / $totalInvestmentAmount) * 100;
                    //    echo $profitSplitPercentage .'--';
                   $profitSplitAmount = round($profitSplitPercentage * $investorsProfitAmount) / 100;
                    //    echo $profitSplitAmount .'<br>';
                   
                    $data = [
                        'status' => 1,
                        'dated' => date('Y-m-d'),
                        'amount' => $profitSplitAmount,
                        'sale_id' => $sale->id,
                        'investment_id' => $investment->investment_id,
                        'investor_id' => $investment->investor_id,
                    ];

                    $amountPaidAdded = PurchaseInvestmentReturn::create($data);
                }

            }

        }

        if($request->now_pay > 0) {
            $data = [
                'dated' => date('Y-m-d'),
                'amount' => $request->now_pay,
                'fine' => isset($request->fine) ? $request->fine : 0,
                'sale_id' => $sale->id,
                'customer_id' => $sale->customer_id,
            ];

            $amountPaidAdded = SaleRecovery::create($data);
        }

        $redirectTo = $type == 'quotation' ? 'quotations' : 'sales';

        return redirect()->route($redirectTo.'.index')->with('success','Sale updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        dd('aa');
        Sale::find($sale->id)->delete();
        return redirect()->route('sales.index')->with('success','Sale deleted successfully');
    }
    

    public function invoice(Request $request, Sale $sale)
    {
        // $data = Sale::find($request->id);
        $data = Sale::with([
            'customer',
            'saleProducts.product',
            'saleRecoveries',
        ])->find($request->id);
        $saleProducts = SaleProducts::orderBy('product_id')->where('sale_id', $request->id)->get();


        // dd($data);
        return view('admin.sales.invoice',compact('data', 'saleProducts'));
    }
}
