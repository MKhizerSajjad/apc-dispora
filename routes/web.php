<?php


use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\ProductCat;
use App\Models\Purchase;
use App\Models\PurchaseProducts;
use App\Models\PurchaseInvestment;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvestorController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProductTypesController;
use App\Http\Controllers\ProductCatController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReportingController;
use App\Http\Controllers\SaleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes(['verify' => true]);

// Route::get('/', function () {return view('admin.dashboard');})->name('home');
// Route::get('/', function () {
//     return view('dashboard');
// });
// Route::get('/about', function () {
//     return view('about-us');
// })->name('about');
// Route::get('/contact', function () {
//     return view('contact-us');
// })->name('contact');

Route::group(['middleware' => ['auth']], function () { //'verified',
    Route::get('/', function () {return view('admin.dashboard');})->name('index');
    Route::get('/home', function () {return view('admin.dashboard');})->name('home');
    Route::get('/dashboard', function () {return view('admin.dashboard');})->name('dashboard');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('donations', DonationController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('investors', InvestorController::class);
    Route::resource('investments', InvestmentController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('product-types', ProductTypesController::class);
    Route::resource('product-cats', ProductCatController::class);
    Route::resource('product-sub-cats', ProductCatController::class);
    Route::resource('products', ProductController::class);

    Route::resource('purchases', PurchaseController::class);

    Route::get('/investorInvestments', function(Request $request) {
      $investorId = $request->input('investor_id');
      $investments = Investment::where('investor_id', $investorId)->pluck('amount', 'id');

      $options = '<option value="" required>Select Investment</option>';
      foreach ($investments as $id => $amount) {
        $options .= '<option value="' . $id . '"> ' . $amount . '</option>';
      }

      return $options;
    })->name('investorInvestments');

    Route::get('/getProductSubCats', function(Request $request) {
      $catId = $request->input('cat_id');
      $subCats = ProductCat::where('parent_id', $catId)->pluck('name', 'id');

      $options = '<option value="" required>Select Sub Category</option>';
      foreach ($subCats as $id => $name) {
        $options .= '<option value="' . $id . '"> ' . $name . '</option>';
      }

      return $options;
    })->name('getProductSubCats');

    Route::get('/getProductPrices', function(Request $request) {
      $productId = $request->input('product_id');
      $productPrices = PurchaseProducts::where('product_id', $productId)->pluck('unit_price', 'purchase_id');

      $options = '<option value="" required>Select Purchase Unit Price</option>';
      foreach ($productPrices as $purchase_id => $unit_price) {
        $options .= '<option value="' . $purchase_id.'|'.$unit_price . '"> ' . $unit_price . '</option>';
      }

      return $options;
    })->name('getProductPrices');

    Route::get('/getProductProfit', function(Request $request) {

      // *************************   AJAX CALL    ******************************
      // Add a change event listener to the Product dropdown
      //   $(document).on('change', '#product_purchase_prices', function() {
      //     var purchaseId = $(this).val();
      //     var myProfitPercentage = $(this).val();
      //     var salePrice = $(this).val();
      //     var investmentSelect = document.getElementById('profit');

      //     if (purchaseId) {

      //       var myProfitAmount = (myProfitPercentage * salePrice) / 100;
      //       var investorProfitAmount = salePrice - myProfitAmount;

      //         var url = $('#product_prices').data('url');
      //         // If an product_purchase_prices is selected, make an AJAX request to get the Price
      //         $.ajax({
      //             url: url,
      //             type: 'GET',
      //             data: {
      //               purchase_id: purchaseId,
      //               investors_profit_amount: investorsProfitAmount,
      //             },
      //             success: function(data) {
      //                 // Update HTML content getting from response
      //                 $('#product_prices').html(data);
      //                 // $('#product_prices').prop('disabled', false);
      //             }
      //         });
      //     } else {
      //         // If no child cat found, clear dropdown
      //         $('#product_prices').html('');
      //         // $('#product_prices').prop('disabled', true);
      //     }
      // });


      $purchaseId = $request->input('purchase_id');
      $investorsProfitAmount = $request->input('investors_profit_amount');
      // $myProfitPercentage = $request->input('my_profit_percentage');

      $purchaseAmount = Purchase::where('id', $purchaseId)->pluck('total_amount')->first();
      $investments = PurchaseInvestment::where('purchase_id', $purchaseId)->select('amount', 'profit_percentage')->get();

      $investorsProfit = 0;

      foreach($investments as $investments) {

        $profitPercentages = ($investments->amount * 100) /  $purchaseAmount;

        $eachInvestorSaleProfit = ($profitPercentages * $investorsProfitAmount) / 100;

        $investorsProfit = $investorsProfit + $eachInvestorSaleProfit;

      }
      return $investorsProfit;
    })->name('getProductProfit');

    Route::get('/purchases/{id}/invoice', [PurchaseController::class, 'invoice'])->name('purchaseInvoice');
    Route::get('/sales/{id}/invoice', [SaleController::class, 'invoice'])->name('saleInvoice');


    // Route::get('/purchases/investments', [PurchaseController::class, 'investorInvestments'])->name('investorInvestments');
    Route::get('/purchases/{id}/investments', [PurchaseController::class, 'investment'])->name('investment');
    Route::post('/purchases/{id}/investmentstore', [PurchaseController::class, 'investmentStore'])->name('investment');

    Route::resource('sales', SaleController::class);
    Route::resource('quotations', SaleController::class);
    Route::resource('credit-sales', SaleController::class);
    // Route::get('/credit-sales', [SaleController::class, 'creditSales'])->name('credit-sales');
    // Route::get('/cquotations', [SaleController::class, 'creditSales'])->name('credit-sales');

    // Reporting
    Route::get('/report', [ReportingController::class, 'index'])->name('report');
    Route::get('/balancesheet', [ReportingController::class, 'balanceSheet'])->name('balancesheet');
    Route::get('/sale-report', [ReportingController::class, 'sale'])->name('sale-report');
    Route::get('/purchase-report', [ReportingController::class, 'purchase'])->name('purchase-report');
    Route::get('/investment-report', [ReportingController::class, 'investment'])->name('investment-report');
    Route::get('/customer-ledger', [ReportingController::class, 'customerLedger'])->name('customer-ledger');
    Route::get('/supplier-ledger', [ReportingController::class, 'supplierLedger'])->name('supplier-ledger');
    Route::get('/investor-ledger', [ReportingController::class, 'investorLedger'])->name('investor-ledger');

    // Route::delete('customers/{id}', [CustomerController::class, 'destroy'])->name('delete');

    #your accessable routes after login of verified account

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // Route::resource('roles', RoleController::class);
    // Route::resource('users', UserController::class);
    // Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

});
