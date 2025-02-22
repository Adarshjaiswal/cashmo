<?php

// Controllers

use App\Http\Controllers\AEPSController;
use App\Http\Controllers\BBPSController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\MobileRechargeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\QueryController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PlanController;
use App\Models\PlanCategory;
// Packages
use Illuminate\Support\Facades\Route;

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

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});


//Landing-Pages Routes
Route::group(['prefix' => 'landing-pages'], function() {
Route::get('index',[HomeController::class, 'landing_index'])->name('landing-pages.index');
Route::get('blog',[HomeController::class, 'landing_blog'])->name('landing-pages.blog');
Route::get('blog-detail',[HomeController::class, 'landing_blog_detail'])->name('landing-pages.blog-detail');
Route::get('about',[HomeController::class, 'landing_about'])->name('landing-pages.about');
Route::get('contact',[HomeController::class, 'landing_contact'])->name('landing-pages.contact');
Route::get('ecommerce',[HomeController::class, 'landing_ecommerce'])->name('landing-pages.ecommerce');
Route::get('faq',[HomeController::class, 'landing_faq'])->name('landing-pages.faq');
Route::get('feature',[HomeController::class, 'landing_feature'])->name('landing-pages.feature');
Route::get('pricing',[HomeController::class, 'landing_pricing'])->name('landing-pages.pricing');
Route::get('saas',[HomeController::class, 'landing_saas'])->name('landing-pages.saas');
Route::get('shop',[HomeController::class, 'landing_shop'])->name('landing-pages.shop');
Route::get('shop-detail',[HomeController::class, 'landing_shop_detail'])->name('landing-pages.shop-detail');
Route::get('software',[HomeController::class, 'landing_software'])->name('landing-pages.software');
Route::get('startup',[HomeController::class, 'landing_startup'])->name('landing-pages.startup');
});

//UI Pages Routs
Route::get('/', [HomeController::class, 'signin'])->name('auth.signin');

Route::group(['middleware' => 'auth'], function () {
    // Permission Module
    Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission',PermissionController::class);
    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/mobile-recharge', [HomeController::class, 'mobileRecharge'])->name('mobileRecharge');
    Route::get('/add-money-to-wallet', [HomeController::class, 'addMoneyToWallet'])->name('addMoneyToWallet');
    //Query Methods

    Route::get('/anyQuery', [QueryController::class, 'anyQuery'])->name('anyQuery');
    Route::post('/add-query', [QueryController::class, 'addQuery'])->name('addQuery');
    Route::get('/added-queries', [QueryController::class, 'getAddedqueries'])->name('queries.added');

    // Wallet Add fund
    Route::post('/add-fund', [WalletController::class, 'addFund'])->name('addFund');
    Route::get('/wallet-deposits', [WalletController::class, 'getDeposits'])->name('wallet.deposits');
    Route::get('/all-transactions-data', [WalletController::class, 'allUserTransactionData'])->name('wallet.allUserTransactionData');
///Admin wallet routes
Route::get('/admin/wallet', [WalletController::class, 'AllWalletRequestsView'])->name('AllWallets.view');
Route::get('/admin/wallet-deposits', [WalletController::class, 'AllWalletRequests'])->name('wallet.data');
Route::post('/wallet/confirm', [WalletController::class, 'confirmDeposit'])->name('wallet.confirm');
Route::post('/wallet/reject', [WalletController::class, 'rejectDeposit'])->name('wallet.reject');
Route::get('/admin/commission',[WalletController::class,'commission'])->name('commission');
Route::post('/admin/commission-update',[WalletController::class,'updateCommission'])->name('commission.update');


Route::get('/admin/packages', [PackageController::class, 'index'])->name('AllPackage.index');
Route::get('/admin/packages-data', [PackageController::class, 'AllPackages'])->name('packages.data');
Route::post('/admin/package/toggle-status', [PackageController::class, 'toggleStatus'])->name('package.toggleStatus');
Route::post('/admin/package/store', [PackageController::class, 'store'])->name('packages.store');
Route::get('/admin/package/{id}/edit', [PackageController::class, 'edit'])->name('packages.edit');
Route::post('/admin/package/update', [PackageController::class, 'update'])->name('packages.update');
Route::get('/admin/package/{id}/recharge-and-bills', [PackageController::class, 'showRechargeAndBills'])->name('packages.rechargeAndBills');
Route::get('/admin/package/{package}/recharge-bills-data', [PackageController::class, 'getRechargeBillsData'])->name('admin.package.recharge-bills.data');
Route::post('/admin/package/commission/update', [PackageController::class, 'updateCommission'])->name('admin.package.commission.update');


// Plan Category
Route::get('/admin/plan-category', [PlanController::class, 'CategoryView'])->name('AllPlanCategory');
Route::get('/admin/plan-category-data', [PlanController::class, 'AllPlanCategories'])->name('AllPlanCategories.data');


//add funds
Route::post('/users/add-funds', [UserController::class, 'addFunds'])->name('users.addFunds');

/// aeps routes users
Route::get('/users/aeps', [AEPSController::class, 'index'])->name('AEPS.index');
Route::get('/users/aeps/balance-info', [AEPSController::class, 'balanceinfo'])->name('AEPS.balanceinfo');
Route::get('/users/aeps/mini-statement', [AEPSController::class, 'miniStatement'])->name('AEPS.miniStatement');
Route::get('/users/aeps/withdrawal', [AEPSController::class, 'withdrawal'])->name('AEPS.withdrawal');
Route::get('/users/aeps/atm-withdrawal', [AEPSController::class, 'ATMwithdrawal'])->name('AEPS.ATMwithdrawal');

///// BBPS  ROUTES
Route::get('/users/bbps', [BBPSController::class, 'index'])->name('BBPS.index');
Route::get('/users/bbps/electricity-bill', [BBPSController::class, 'electricity'])->name('BBPS.electricityBill');
Route::get('/users/bbps/gas-bill', [BBPSController::class, 'gasBill'])->name('BBPS.gasBill');
Route::get('/users/bbps/water-bill', [BBPSController::class, 'waterBill'])->name('BBPS.waterBill');
Route::get('/users/bbps/broadband-bill', [BBPSController::class, 'broadbandBill'])->name('BBPS.broadbandBill');
Route::get('/users/bbps/landline-bill', [BBPSController::class, 'landlineBill'])->name('BBPS.landlineBill');
Route::get('/users/bbps/tax-muncipal', [BBPSController::class, 'taxMuncipal'])->name('BBPS.taxMuncipal');
Route::get('/users/bbps/digital-voucher', [BBPSController::class, 'digitalVoucher'])->name('BBPS.digitalVoucher');
Route::get('/users/bbps/insurance', [BBPSController::class, 'insurance'])->name('BBPS.insurance');
Route::get('/users/bbps/loan-repayment', [BBPSController::class, 'loanRepayment'])->name('BBPS.loanRepayment');


Route::get('/admin/all-queries-view', [QueryController::class, 'AllQueriesView'])->name('AllQuery.view');
Route::get('/admin/all-queries', [QueryController::class, 'AllQueriesRequest'])->name('AllQuery.data');
Route::post('/admin/update-admin-response', [QueryController::class, 'updateAdminResponse'])->name('update.admin.response');
/// Recharge
Route::post('/mobile-recharge', [MobileRechargeController::class, 'recharge']);
Route::get('/mobile-recharges', [MobileRechargeController::class, 'getMobileRecharges'])->name('mobile.recharges');
Route::get('/all-transactions', [WalletController::class, 'allUserTransactionView'])->name('wallet.allUserTransactionView');

    // Users Module
    Route::resource('users', UserController::class);
});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function() {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

//Error Page Route
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});


//Table Page Routs
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});
//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');



////Mobile Recharge Route



///New user routes
// routes/web.php
Route::get('/users/change-status/{id}', [UserController::class, 'changeStatus'])->name('users.change-status');


