<?php
 
 use Illuminate\Support\Facades\Route;
 use App\Http\Controllers\AuthController;
 use App\Http\Controllers\ProductController;
 use App\Http\Controllers\ProjectController;
 
 Route::get('/', function () {
     return view('welcome');
 });
 
 Route::group(['prefix' => 'auth'], function () {
     Route::get('register', [AuthController::class, 'register'])->name('register');
     Route::post('register', [AuthController::class, 'registerSave'])->name('register.save');
 
     Route::get('login', [AuthController::class, 'login'])->name('login');
     Route::post('login', [AuthController::class, 'loginAction'])->name('login.action');
 
     Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
 });
 
 Route::middleware('auth')->group(function () {
     Route::get('dashboard', function () {
         return view('dashboard');
     })->name('dashboard');
     
     Route::group(['prefix' => 'products'], function () {
        Route::get('', [ProductController::class, 'index'])->name('products');
        Route::get('create', [ProductController::class, 'create'])->name('products.create');
        Route::post('store', [ProductController::class, 'store'])->name('products.store');
        Route::get('show/{id}', [ProductController::class, 'show'])->name('products.show');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('edit/{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('destroy/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
     Route::group(['prefix' => 'project'], function () {
         Route::get('', [ProjectController::class, 'index'])->name('project');
         Route::get('create', [ProjectController::class, 'create'])->name('project.create');
         Route::post('store', [ProjectController::class, 'store'])->name('project.store');
         Route::get('show/{id}', [ProjectController::class, 'show'])->name('project.show');
         Route::get('edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
         Route::put('edit/{id}', [ProjectController::class, 'update'])->name('project.update');
         Route::delete('destroy/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
     });
     
 
     Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
 });
 