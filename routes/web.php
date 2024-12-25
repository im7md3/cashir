<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Livewire;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\Supplier;
use App\Http\Livewire\Packages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProductsController;
use App\Http\Livewire\PaymentMethods;
use App\Http\Livewire\Purchases\CreatePurchases;
use App\Http\Livewire\Purchases\EditPurchases;
use App\Http\Livewire\Purchases\Purchases;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// livewire group
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::get('login', [AuthController::class, 'login'])->name('login');
        Route::post('login', [AuthController::class, 'store'])->name('login');

        Route::middleware('auth')->group(function () {
            Route::get('/', [HomeController::class, 'home'])->name('home');

            Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

            Route::view('users', 'users.index')->name('users');
            Route::view('program-additions', 'program-additions')->name('program-additions');
            // Route::view('suppliers', 'suppliers.index')->name('suppliers');
            // Route::view('suppliers/create', 'suppliers.create')->name('suppliers.create');
            Route::resource('/admins', AdminController::class);
            Route::resource('/roles', RoleController::class);
            Route::resource('/clients', ClientController::class);
            Route::resource('/suppliers', SupplierController::class);

            Route::resource('/departments', DepartmentController::class);
            Route::resource('/branches', BranchController::class);
            Route::resource('/settings', SettingController::class);
            Route::resource('/reservations', ReservationController::class);

            // Route::view('settings', 'settings')->name('settings');
            // Route::view('branches', 'branch.index')->name('branches');
            Route::get('purchases', Purchases::class)->name('purchases');
            Route::get('purchases/create', CreatePurchases::class)->name('purchases.create');
            Route::get('purchases/{purchase}/edit', EditPurchases::class)->name('purchases.edit');

            // Route::view('clients', 'clients.index')->name('clients');
            // Route::view('departments', 'department.index')->name('departments');
            Route::get('clients/invocie/{client}', function (Client $client) {
                $invoices = $client->invoices()->paginate(10);
                return view('clients.invoices', compact('client', 'invoices'));
            })->name('clients.invoice');
            Route::view('user_categories', 'user_categories.index')->name('user_categories');
            Route::view('expenses', 'expenses.index')->name('expenses');
            Route::view('expense_categories', 'expense_categories.index')->name('expense_categories');
            Route::view('products', 'product.index')->name('products');
            Route::get('products/print', [ProductsController::class, 'print'])->name('products.print');
            Route::view('units', 'units.index')->name('units');
            Route::view('offers', 'offers.index')->name('offers');
            Route::view('invoices/create', 'invoices.create')->name('invoices.create');
            Route::view('invoices', 'invoices.index')->name('invoices.index');
            Route::view('invoices/free', 'invoices.free-clients')->name('invoices.free');
            Route::get('invoices/{invoice}', function ($id) {
                return view('invoices.show', compact('id'));
            })->name('invoices.show');
            Route::get('invoices/bonds/{invoice}', function (Invoice $invoice) {
                return view('invoices.bonds', compact('invoice'));
            })->name('invoices.bonds');

            Route::prefix('reports')->name('reports.')->group(function () {
                Route::view('/invoice', 'reports.invoice');
                Route::view('/show-invoices', 'reports.invoices');
                Route::view('/treasury', 'reports.treasury')->name('treasury');
                Route::view('/general', 'reports.general')->name('general');
                Route::view('/client', 'reports.client')->name('client');
                Route::view('/user', 'reports.user')->name('user');
                Route::view('/product', 'reports.product')->name('product');
                Route::view('/salesReport', 'reports.salesReport')->name('salesReport');
                Route::view('/financial-sessions', 'reports.financial-sessions')->name('financial-sessions');
            });

            Route::view('notifications', 'notifications')->name('notifications');
            Route::get('/notifications/deleteAll', [NotificationController::class, 'deleteAll'])->name('deleteAllNotifications');

            Route::get('/markAsRead', function () {
                auth()->user()->unreadNotifications->markAsRead();
                return redirect()->back();
            })->name('markAsRead');

            Route::get('payment_methods', PaymentMethods::class)->name('payment_methods');

            Route::view('accounting', 'accounting')->name('accounting');
            Route::view('LabelMaker', 'LabelMaker')->name('LabelMaker');
            Route::get('/const', Livewire\ConstSettings::class)->name('const-settings');
            //Route::get('packages', Packages::class)->name('packages');
            Route::view('packages', 'packages.index')->name('packages');
            Route::view('using_packages', 'using_packages')->name('using_packages');
        });
    }
);
