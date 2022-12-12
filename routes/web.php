<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return redirect()->route('auth.login');
});
Route::prefix('home')->group(function () {
    Route::get('/product', [HomeController::class, 'product'])->name('home.product');
    Route::get('/post', [HomeController::class, 'post'])->name('home.post');
    Route::get('/ajax/post', [HomeController::class, 'postAjax']);
});

// product resource controller
Route::resource('product', ProductController::class)->except(['show', 'index'])->middleware('withAuth');
Route::get('/product/', [ProductController::class, 'index'])->name('product.list');

// post resource controller
Route::resource('post', PostController::class)
    ->scoped([
        'post' => 'slug'
    ])
    ->middleware('withAuth')
    ->except(['index', 'show']);
Route::get('/post', [PostController::class, 'index'])->name('post.index');
/* This is a route for showing a single post. */
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('post.show');


// auth route
Route::name('auth.')->prefix('auth')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login')->middleware('noAuth');
    Route::post('/login', [AuthController::class, 'do_login'])->name('do_login')->middleware('noAuth');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('withAuth');
});
