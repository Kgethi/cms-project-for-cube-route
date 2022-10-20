<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegistrationController;

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



Route::get('/login', [LoginController::class, 'viewLogin'])->name('login');
Route::post('/login', [LoginController::class, 'authentication']);

Route::get('/register', [RegistrationController::class, 'viewRegister'])->name('register');
Route::post('/register', [RegistrationController::class, 'register']);



Route::middleware(['auth'])->group(function () {


    Route::get('/', [HomeController::class, 'index'])->name('home');

    //Category Routes
    Route::get('/categories', [CategoryController::class, 'viewCategories'])->name('categories');
    Route::get('/add-category', [CategoryController::class, 'viewCategoryForm'])->name('addCategory');
    Route::post('/add-category', [CategoryController::class, 'addCategory']);
    Route::post('/delete-category', [CategoryController::class, 'deleteCategory']);
    Route::get('/edit-category/{categoryID}', [CategoryController::class, 'editCategory']);
    Route::post('/edit-category/{categoryID}', [CategoryController::class, 'updateCategory']);
    Route::get('/{categoryID}/products', [CategoryController::class, 'showMyProducts']);


    //Product Routes 
    Route::get('/products', [ProductController::class, 'showProducts'])->name('products');
    Route::get('/add-product', [ProductController::class, 'viewProductForm'])->name('addProduct');
    Route::post('/add-product', [ProductController::class, 'addProduct']);
    Route::post('/delete-product', [ProductController::class, 'deleteProduct']);
    Route::get('edit-product/{productID}', [ProductController::class, 'editProduct']);
    Route::post('edit-product/{productID}', [ProductController::class, 'updateProduct']);
    Route::get('/{productID}/variants', [ProductController::class, 'showMyVariants']);

    //Variant Routes
    Route::post('/delete-variant', [VariantController::class, 'deleteVariant']);
    Route::get('/variants', [VariantController::class, 'showVariants'])->name('variants');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
