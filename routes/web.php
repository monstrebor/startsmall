<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\{ManageUserController, AdminController, LoginController, RegisterController, SettingsController, ExpenseController};
use App\Http\Controllers\{ProductController, SaleController};
use App\Http\Controllers\users\CashierController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home.landing-page');
})->name('home');

Route::get('/login', function () {
    return view('home.index');
})->name('login');

Route::get('/register', function () {
    return view('home.index');
})->name('register');


/*
|--------------------------------------------------------------------------
| Guest Routes (Unauthenticated)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::post('/login-store', [LoginController::class, 'login'])->name('login.store');
    Route::post('/register-store', [RegisterController::class, 'store'])->name('register.store');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

    //Manage user
    Route::get('admin-create-user', [ManageUserController::class, 'index'])->name('admin-create-user.dashboard');
    Route::post('admin-create-user-store', [ManageUserController::class, 'store'])->name('admin-create-user.store');
    Route::post('admin-create-user-update', [ManageUserController::class, 'update'])->name('admin-create-user.update');
    Route::patch('/admin/users/{user}/toggle-status', [ManageUserController::class, 'toggleStatus'])->name('admin.users.toggle-status');

    //Product
    Route::get('/product', [ProductController::class, 'index'])->name('product.dashboard');
    Route::post('/product-store', [ProductController::class, 'store'])->name('product.store');
    Route::post('/product-update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');

    //Reports
    Route::get('/reports/walkins', [AdminController::class, 'walkinReport'])->name('admin.reports.walkins');
    Route::get('/reports/return-exchange', [AdminController::class, 'returnExchangeReport'])->name('admin.reports.return-exchange');

    //Store Expense Records
    Route::get('/expenses', [ExpenseController::class, 'index'])->name('expenses.index');
    Route::post('/expenses', [ExpenseController::class, 'store'])->name('expenses.store');
});

/*
|--------------------------------------------------------------------------
| Cashier
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:cashier'])->group(function () {
    Route::get('/cashier', [CashierController::class, 'index'])->name('cashier.dashboard');

    Route::get('/cashier-sales', [SaleController::class, 'index'])->name('sales.index');
    Route::post('/sales-store', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/cashier/receipt/{sale}', [SaleController::class, 'receipt'])->name('cashier.receipt');
});

/*
|--------------------------------------------------------------------------
| Logout Route
|--------------------------------------------------------------------------
*/

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Account Route
|--------------------------------------------------------------------------
*/

Route::get('/user-account', [AccountController::class, 'index'])->name('user.dashboard');
Route::post('/user-account/update-email', [AccountController::class, 'updateEmail'])->name('user-email.update');
Route::post('/user-account/update', [AccountController::class, 'update'])->name('user.update');

/*
|--------------------------------------------------------------------------
| Update Password Route
|--------------------------------------------------------------------------
*/

Route::post('/password/update', [SettingsController::class, 'passwordUpdate'])
    ->middleware(['auth'])
    ->name('password.update');
