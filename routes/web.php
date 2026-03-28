<?php
// Sanpham routes
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route xử lý cập nhật (dùng PUT hoặc PATCH)
Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

// Route xem chi tiết sản phẩm
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


// User routes
use App\Http\Controllers\UserController;
Route::resource('users', UserController::class); // Tạo tất cả route cần thiết cho UserController (index, create, store, show, edit, update, destroy)


// Auth routes
use App\Http\Controllers\AuthController;
// Guest: Chỉ khách mới vào được
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
// Auth: Phải đăng nhập mới vào được
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('products', ProductController::class);
    Route::resource('users', UserController::class);
});
