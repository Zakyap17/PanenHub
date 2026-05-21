<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Models\Product;

Route::get('/', function () {
    $products = Product::with('user.bankAccounts')->latest()->get(); 
    $mitraBanks = [];
    foreach (\App\Models\User::where('role', 'mitra')->with('bankAccounts')->get() as $mitra) {
        if ($mitra->bankAccounts->count() > 0) {
            $mitraBanks[$mitra->name] = $mitra->bankAccounts;
        }
    }
    return view('home', compact('products', 'mitraBanks'));
})->name('home');

Route::post('/api/register', [AuthController::class, 'register']);
Route::post('/api/register-mitra', [AuthController::class, 'registerMitra']);
Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/logout', [AuthController::class, 'logout']);

Route::get('/auth/{provider}/redirect', [AuthController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard-mitra', function () {
        $userId = \Illuminate\Support\Facades\Auth::id();
        $products = \App\Models\Product::where('user_id', $userId)->latest()->take(3)->get();
        $totalProducts = \App\Models\Product::where('user_id', $userId)->count();
        
        $activeOrdersCount = \App\Models\Order::where('mitra_id', $userId)
                                ->whereIn('status', ['menunggu', 'diproses'])->count();
                                
        $totalRevenue = \App\Models\Order::where('mitra_id', $userId)
                                ->where('status', 'selesai')->sum('total_price');

        $banks = \App\Models\BankAccount::where('user_id', $userId)->get();

        return view('mitra.dashboard', compact('products', 'totalProducts', 'activeOrdersCount', 'totalRevenue', 'banks'));
    })->name('mitra.dashboard');

    Route::get('/mitra/hasil-panen', function () {
        $products = \App\Models\Product::where('user_id', \Illuminate\Support\Facades\Auth::id())->latest()->get();
        return view('mitra.products', compact('products'));
    })->name('mitra.products');

    Route::get('/mitra/pesanan', function (Illuminate\Http\Request $request) {
        $status = $request->query('status');
        $query = \App\Models\Order::with(['buyer', 'items'])
                    ->where('mitra_id', \Illuminate\Support\Facades\Auth::id());
        
        if ($status) {
            $query->where('status', $status);
        }

        $orders = $query->latest()->get();
        return view('mitra.orders', compact('orders', 'status'));
    })->name('mitra.orders');

    Route::get('/buyer/orders', function () {
        $orders = \App\Models\Order::with(['items', 'mitra'])
                    ->where('buyer_id', \Illuminate\Support\Facades\Auth::id())
                    ->latest()
                    ->get();
        return view('buyer.orders', compact('orders'));
    })->name('buyer.orders');

    Route::get('/api/products', [ProductController::class, 'index']); 
    Route::post('/api/products/store', [ProductController::class, 'store'])->name('product.store'); 
    Route::post('/api/products/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/api/products/{id}/delete', [ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('/api/orders/{id}/next-status', [\App\Http\Controllers\OrderController::class, 'nextStatus'])->name('order.nextStatus');

    Route::post('/api/checkout', [\App\Http\Controllers\OrderController::class, 'checkout'])->name('checkout');

    Route::post('/api/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');

    Route::post('/api/bank/store', [ProductController::class, 'storeBank'])->name('mitra.bank.store');
    Route::post('/api/bank/{id}/update', [ProductController::class, 'updateBank'])->name('mitra.bank.update');
    Route::post('/api/bank/{id}/delete', [ProductController::class, 'destroyBank'])->name('mitra.bank.destroy');
});