<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Sale;
use App\Models\Purchase;
use App\Models\Customer;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\PurchaseInvestmentReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class ReportingController extends Controller
{
    public function index(Request $request)
    {
        // // Get total purchases by date
        // $totalPurchases = DB::table('purchases')
        // // ->whereBetween('dated', [$from_date, $to_date])
        // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_purchase'))
        // ->groupBy('date')
        // ->get();

        // // Get total investments by date
        // $totalInvestments = DB::table('purchase_investments')
        // ->join('investments', 'purchase_investments.investment_id', '=', 'investments.id')
        // ->select(
        //     DB::raw('DATE_FORMAT(purchase_investments.created_at, "%Y-%m-%d") as date'), 
        //     DB::raw('SUM(investments.amount) as total_investments'), 
        //     DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
            
        //     // DB::raw('DATE_FORMAT(purchase_investments.created_at, "%Y-%m-%d") as date'), 
        //     // DB::raw('DATE_FORMAT(investments.dated, "%Y-%m-%d") as date', 'SUM(investments.amount) as total_investments'), 
        //     // DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
        // )
        // ->groupBy('date')
        // ->get();

        // // Get total sales by date
        // $totalSales = DB::table('sales')
        // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_sales'))
        // ->groupBy('date')
        // ->get();

        // // Get total recoveries by date
        // $totalRecoveries = DB::table('sale_recoveries')
        // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as total_recoveries'), DB::raw('SUM(fine) as total_fine'))
        // ->groupBy('date')
        // ->get();

        $filters = $request->all();
        $from_date = $request->from;
        $to_date = $request->to;
        // dd($from_date . $to_date);

        // Get total purchases by date
        $totalPurchases = DB::table('purchases')
        ->whereBetween('dated', [$from_date, $to_date])
        ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_purchase'))
        ->groupBy('date')
        ->get();

        // Get total investments by date
        $totalInvestments = DB::table('purchase_investments')
        ->join('investments', 'purchase_investments.investment_id', '=', 'investments.id')
        ->whereBetween('purchase_investments.created_at', [$from_date, $to_date])
        ->select(
            DB::raw('DATE_FORMAT(purchase_investments.created_at, "%Y-%m-%d") as date'), 
            DB::raw('SUM(investments.amount) as total_investments'), 
            DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
        )
        ->groupBy('date')
        ->get();

        // Get total sales by date
        $totalSales = DB::table('sales')
        ->whereBetween('dated', [$from_date, $to_date])
        ->where('type', '!=', 'quotation')
        ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_sales'))
        ->groupBy('date')
        ->get();

        // Get total recoveries by date
        $totalRecoveries = DB::table('sale_recoveries')
        ->whereBetween('dated', [$from_date, $to_date])
        ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as total_recoveries'), DB::raw('SUM(fine) as total_fine'))
        ->groupBy('date')
        ->get();

        // Merge the results together
        $results = collect($totalPurchases)->merge($totalInvestments)->merge($totalSales)->merge($totalRecoveries)->groupBy('date');

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.index-print',compact('results', 'filters'));
        } else {
            // Return the regular page
            return view('admin.reportings.index',compact('results', 'filters'));
        }
    }
    
    // public function balanceSheet(Request $request)
    // {

    //     $filters = $request->all();
    //     $from_date = $request->from;
    //     $to_date = $request->to;
    //     // dd($from_date . $to_date);

    //     // // Get total purchases by date
    //     // $totalPurchases = DB::table('purchases')
    //     // ->whereBetween('dated', [$from_date, $to_date])
    //     // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_purchase'))
    //     // ->groupBy('date')
    //     // ->get();

    //     // // Get total sales by date
    //     // $totalSales = DB::table('sales')
    //     // ->whereBetween('dated', [$from_date, $to_date])
    //     // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(total_amount) as total_sales'))
    //     // ->groupBy('date')
    //     // ->get();

    //     // // Get total investments by date
    //     // $totalInvestments = DB::table('purchase_investments')
    //     // ->join('investments', 'purchase_investments.investment_id', '=', 'investments.id')
    //     // ->whereBetween('purchase_investments.created_at', [$from_date, $to_date])
    //     // ->select(
    //     //     DB::raw('DATE_FORMAT(purchase_investments.created_at, "%Y-%m-%d") as date'), 
    //     //     DB::raw('SUM(investments.amount) as total_investments'), 
    //     //     DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
    //     // )
    //     // ->groupBy('date')
    //     // ->get();

    //     // // Get total recoveries by date
    //     // $totalRecoveries = DB::table('sale_recoveries')
    //     // ->whereBetween('dated', [$from_date, $to_date])
    //     // ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as total_recoveries'), DB::raw('SUM(fine) as total_fine'))
    //     // ->groupBy('date')
    //     // ->get();
        
    //     // // Get total investment returns by date
    //     // $investmentReturns = DB::table('purchase_investment_returns')
    //     // ->whereBetween('dated', [$from_date, $to_date])
    //     // ->select(
    //     //     DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'),
    //     //     DB::raw('(SELECT SUM(amount) FROM purchase_investment_returns WHERE dated = date AND investment_id IS NULL AND investor_id IS NULL) as company_profit'),
    //     //     DB::raw('SUM(amount) as investors_profit')
    //     // )
    //     // ->groupBy('date')
    //     // ->get();


    //      // Get total purchases by date
    //      $totalPurchases = DB::table('purchases')
    //     //  ->select(DB::raw('SUM(total_amount) as total_purchase'))
    //     //  ->groupBy('date')
    //      ->get();
 
    //      // Get total sales by date
    //      $totalSales = DB::table('sales')
    //     //  ->select(DB::raw('SUM(total_amount) as total_sales'))
    //     //  ->groupBy('date')
    //      ->get();
 
    //      // Get total investments by date
    //      $totalInvestments = DB::table('purchase_investments')
    //      ->join('investments', 'purchase_investments.investment_id', '=', 'investments.id')
    //     //  ->select(
    //     //     //  DB::raw('DATE_FORMAT(purchase_investments.created_at, "%Y-%m-%d") as date'), 
    //     //      DB::raw('SUM(investments.amount) as total_investments'), 
    //     //      DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
    //     //  )
    //     //  ->groupBy('date')
    //      ->get();
 
    //      // Get total recoveries by date
    //     $totalRecoveries = DB::table('sale_recoveries')
    //     ->whereBetween('dated', [$from_date, $to_date])
    //     ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as total_recoveries'), DB::raw('SUM(fine) as total_fine'))
    //     ->groupBy('date')
    //     ->get();

    //      $investmentReturns = DB::table('purchase_investment_returns')
    //     ->whereBetween('dated', [$from_date, $to_date])
    //     ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as company_profit'), DB::raw('SUM(amount) as investors_profit'))
    //     ->groupBy('date')
    //     ->get();

    //      $companyReturns = DB::table('purchase_investment_returns')
    //     ->whereBetween('dated', [$from_date, $to_date])
    //     ->whereNull('investment_id')
    //     ->whereNull('investor_id')
    //     ->select(DB::raw('DATE_FORMAT(dated, "%Y-%m-%d") as date'), DB::raw('SUM(amount) as company_profit'), DB::raw('SUM(amount) as investors_profit'))
    //     ->groupBy('date')
    //     ->get();



    //     // Merge the results together
    //     $results = collect($totalPurchases)->merge($totalInvestments)->merge($totalSales)->merge($totalRecoveries)->merge($investmentReturns)->groupBy('date')->sortBy(function ($items, $date) {return strtotime($date);});
    //     $results = $totalPurchases->concat($totalInvestments)->concat($totalSales)->concat($totalRecoveries)->concat($investmentReturns);
        
    //     dd($results);
    //     // $results = [$totalPurchases
    //     // ,$totalInvestments
    //     // ,$totalSales
    //     // ,$totalRecoveries
    //     // ,$investmentReturns];
        
    //     // dd($results);
    //     // dd($results[0]->total_purchase);

    //     if ($request->has('print') && $request->print) {
    //         // Return the print page
    //         return view('admin.reportings.balancesheet',compact('results', 'filters'));
    //     } else {
    //         // Return the regular page
    //         return view('admin.reportings.balancesheet-print',compact('results', 'filters'));
    //     }
    // }
    
    public function balanceSheet(Request $request)
    {

        $filters = $request->all();

        if(isset($filters)) {
                
            $fromDate = $request->from;
            $toDate = $request->to;

            // Get total purchases by date
            $totalPurchases = DB::table('purchases')
                ->select(DB::raw('SUM(total_amount) as total_purchase'))
                ->whereBetween('dated', [$fromDate, $toDate])
                ->get();

            // Get total sales by date
            $totalSales = DB::table('sales')
                ->select(DB::raw('SUM(total_amount) as total_sales'))
                ->whereBetween('dated', [$fromDate, $toDate])
                ->where('type', '!=', 'quotation')
                ->get();

            // Get total investments by date
            $totalInvestments = DB::table('purchase_investments')
                ->join('investments', 'purchase_investments.investment_id', '=', 'investments.id')
                ->select(
                    DB::raw('SUM(investments.amount) as total_investments'), 
                    DB::raw('SUM(investments.amount * (profit_percentage/100)) as profit')
                )
                ->whereBetween('purchase_investments.created_at', [$fromDate, $toDate])
                ->get();

            // Get total recoveries by date
            $totalRecoveries = DB::table('sale_recoveries')
                ->select(DB::raw('SUM(amount) as total_recoveries'), DB::raw('SUM(fine) as total_fine'))
                ->whereBetween('dated', [$fromDate, $toDate])
                ->get();

            // Get total investment returns by date
            $investmentReturns = DB::table('purchase_investment_returns')
                ->select(
                    DB::raw('(SELECT SUM(amount) FROM purchase_investment_returns WHERE investment_id IS NULL AND investor_id IS NULL) as company_profit'),
                    DB::raw('SUM(amount) as investors_profit')
                )
                ->whereBetween('dated', [$fromDate, $toDate])
                ->get();



            // Merge the results together
            // $results = collect($totalPurchases)->merge($totalInvestments)->merge($totalSales)->merge($totalRecoveries)->merge($investmentReturns)->groupBy('date')->sortBy(function ($items, $date) {return strtotime($date);});
            $results = $totalPurchases->concat($totalInvestments)->concat($totalSales)->concat($totalRecoveries)->concat($investmentReturns);
        }

        if ($fromDate && $toDate) {
            // Return the print page
            return view('admin.reportings.balancesheet-print',compact('results', 'filters'));
        } else {
            // Return the regular page
            return view('admin.reportings.balancesheet',compact('results', 'filters'));
        }
    }

    public function sale(Request $request)
    {

        if($request->all() != null) {
            $sales = Sale::with('customer')->orderBy('dated', 'DESC')
            ->where('type', '!=', 'quotation');

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

            $data = $sales->get();

            
        } else {
            $data = [];
        }
        
        $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.sale-print',compact('data', 'filters', 'customers'));
        } else {
            // Return the regular page
            return view('admin.reportings.sale',compact('data', 'filters', 'customers'));
                // ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function purchase(Request $request)
    {

        if($request->all() != null) {
            $sales = Purchase::with('supplier')->orderBy('dated', 'DESC');

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
            if ($request->has('supplier') && $request->supplier) {
                $supplier = $request->supplier;
                $sales = $sales->where('supplier_id', $supplier);
            }

            $data = $sales->get();
            
        } else {
            $data = [];
        }
        
        $suppliers = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.purchase-print',compact('data', 'filters', 'suppliers'));
        } else {
            // Return the regular page
            return view('admin.reportings.purchase',compact('data', 'filters', 'suppliers'));
                // ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function investment(Request $request)
    {

        if($request->all() != null) {


            // *****************************************
                // $investReturns = Investment::with(['investor', 'purchaseInvestments' => function ($query) {
                //     $query->selectRaw('SUM(amount) as total_amount, investment_id')
                //         ->groupBy('investment_id');
                // },
                // 'purchaseInvestmentReturns' => function ($query) {
                //     $query->selectRaw('SUM(amount) as total_amount, investment_id')
                //         ->groupBy('investment_id');
                // }])->orderBy('dated', 'DESC')->get();
            
                // $investReturns = Investor::with(
                //     ['investments' => function ($query) {
                //         $query->with(['purchaseInvestments' => function ($query) {
                //             $query->selectRaw('SUM(amount) as total_amount, investment_id')
                //                     ->groupBy('investment_id');
                //         },
                //         'purchaseInvestmentReturns' => function ($query) {
                //             $query->selectRaw('SUM(amount) as total_amount, investment_id')
                //                     ->groupBy('investment_id');
                //                     // ->whereBetween('dated', [$fromDate, $toDate]);
                //         }])
                //         ->orderBy('dated', 'DESC');
                //     }])
                //     ->orderBy('first_name')
                //     ->get();
            // *****************************************
        

            $fromDate = $request->from;
            $toDate = $request->t0;
            

            $investReturns = Investor::with(
                ['investments' => function ($query) use ($fromDate, $toDate) {
                    $query->with(
                        [
                            'purchaseInvestments' => function ($query) {
                                $query->selectRaw('SUM(amount) as total_amount, investment_id')
                                    ->groupBy('investment_id');
                            },
                            'purchaseInvestmentReturns' => function ($query) use ($fromDate, $toDate) {
                                $query->selectRaw('SUM(amount) as total_amount, investment_id')
                                    ->groupBy('investment_id')
                                    ->orWhereBetween('dated', [$fromDate, $toDate]);
                            }
                        ]
                    )->orderBy('dated', 'DESC');
                }])
                ->orderBy('first_name');
                
            $data = $investReturns->get();

        } else {
            $data = [];
        }

        // $investors = Investor::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.investment-print',compact('data', 'filters'));
        } else {
            // Return the regular page
            return view('admin.reportings.investment',compact('data', 'filters'));
                // ->with('i', ($request->input('page', 1) - 1) * 10);
        }
    }

    public function customerLedger(Request $request)
    {
        if($request->all() != null) {
            $sales = Sale::with('customer')->orderBy('dated', 'DESC')
            ->where('type', '!=', 'quotation');

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

            $data = $sales->get();

            
        } else {
            $data = [];
        }

        // dd($data[0]->customer);
        
        $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.customer-ledger-print',compact('data', 'filters', 'customers'));
        } else {
            // Return the regular page
            return view('admin.reportings.customer-ledger',compact('data', 'filters', 'customers'));
        }

        
        // // $this->validate($request, [
        // //     'customer' => 'required',
        // //     'product' => 'required',
        // // ]);

        // if($request->all() != null) {

            
        //     $customer = $request->customer;
        //     // $product = $request->product;

        //     // $data = Sale::with([
        //     //     'customer',
        //     //     'saleProducts.product',
        //     //     'saleRecoveries',
        //     // ])
        //     // ->whereHas('saleProducts', function ($query) use ($product) {
        //     //     $query->where('product_id', $product);
        //     // })
        //     // ->where('customer_id', $customer)->firstOrFail();
            



        //     $sales = Sale::with('customer')->orderBy('dated', 'DESC');


        //     dd($sales);
        //     // Filter by customer
        //     if ($request->has('customer') && $request->customer) {
        //         $customer = $request->customer;
        //         $sales = $sales->where('customer_id', $customer);
        //     }
            
        //     // Filter by customer
        //     if ($request->has('product') && $request->product) {
        //         $product = $request->product;
        //         $sales = $sales->where('product_id', $product);
        //     }

            
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
        //         $sales = $sales->whereBetween('due_date', [$from, $to]);
        //     }

        //     $data = $sales->paginate(10);

            
        // } else {
        //     $data = [];
        // }
        
        // $customers = Customer::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        // $products = Product::orderBy('name','DESC')->where('status', '1')->get();
        // $filters = $request->all();

        // if ($request->has('print') && $request->print) {
        //     // Return the print page
        //     return view('admin.reportings.customer-ledger-print',compact('data', 'filters', 'customers', 'products'));
        // } else {
        //     // Return the regular page
        //     return view('admin.reportings.customer-ledger',compact('data', 'filters', 'customers', 'products'));
        // }
    }

    public function supplierLedger(Request $request)
    {
        if($request->all() != null) {
            $purchases = Purchase::with('Supplier')->orderBy('dated', 'DESC');

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

            $data = $purchases->get();

        } else {
            $data = [];
        }

        $suppliers = Supplier::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.supplier-ledger-print',compact('data', 'filters', 'suppliers'));
        } else {
            // Return the regular page
            return view('admin.reportings.supplier-ledger',compact('data', 'filters', 'suppliers'));
        }
    }

    public function investorLedger(Request $request)
    {
        if($request->all() != null) {
            $investments = Investment::with('Investor')->orderBy('dated', 'DESC');

            // Filter by status
            if ($request->has('status') && $request->status != '') {
                $status = $request->status;
                $investments = $investments->where('status', $status);
            }

            // Filter by invoice
            if ($request->has('invoice') && $request->invoice != '') {
                $invoice = $request->invoice;
                $investments = $investments->where('invoice_no', 'like', '%'.$invoice.'%');
            }

            // Filter by due date range
            if ($request->has('from') && $request->from && $request->has('to') && $request->to) {
                $from = $request->from;
                $to = $request->to;
                $investments = $investments->whereBetween('dated', [$from, $to]);
            }

            // Filter by customer
            if ($request->has('investor') && $request->investor) {
                $investor = $request->investor;
                $investments = $investments->where('investor_id', $investor);
            }

            $data = $investments->get();

        } else {
            $data = [];
        }

        $investors = Investor::orderBy('first_name','DESC')->orderBy('last_name','DESC')->select('id', 'first_name', 'last_name')->where('status', '1')->get();
        $filters = $request->all();

        if ($request->has('print') && $request->print) {
            // Return the print page
            return view('admin.reportings.investor-ledger-print',compact('data', 'filters', 'investors'));
        } else {
            // Return the regular page
            return view('admin.reportings.investor-ledger',compact('data', 'filters', 'investors'));
        }
    }
}
