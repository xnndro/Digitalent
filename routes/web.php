<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


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
    return view('auth.login');
});
Auth::routes();
Route::get('/auth/redirect', [App\Http\Controllers\Auth\LoginController::class, 'redirectToProvider'])->name('login.google');
Route::get('/auth/callback', [App\Http\Controllers\Auth\LoginController::class, 'handleProviderCallback'])->name('login.google.callback');
// login first to access dashboard
Route::group(['middleware' => 'auth'], function () {
    
    // split by role
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');

    // laundry history for user
    Route::get('/user/laundry', [App\Http\Controllers\UserController::class, 'laundry_status'])->name('user.laundry_status');

    // laundry_vendor
    Route::get('/laundry_vendor', [App\Http\Controllers\LaundryVendorController::class, 'dashboard'])->name('laundry_vendor.dashboard');
    Route::get('/laundry_vendor/laundry', [App\Http\Controllers\LaundryVendorController::class, 'index'])->name('laundry_vendor.index');
    Route::get('/laundry_vendor/laundry/transactionforadmin', [App\Http\Controllers\LaundryVendorController::class, 'transactionforadmin'])->name('laundry_vendor.transactionforadmin');
    Route::get('/laundry_vendor/laundry/{id}/edit', [App\Http\Controllers\LaundryVendorController::class, 'edit'])->name('laundry_vendor.edit');
    Route::put('/laundry_vendor/laundry/{id}', [App\Http\Controllers\LaundryVendorController::class, 'update'])->name('laundry_vendor.update');
    Route::get('/laundry_vendor/history', [App\Http\Controllers\LaundryVendorController::class, 'history'])->name('laundry_vendor.history');
    Route::get('/laundry_vendor/laundry/{id}/done', [App\Http\Controllers\LaundryVendorController::class, 'done'])->name('laundry_vendor.done');
    Route::get('/laundry_vendor/laundry/{id}/process', [App\Http\Controllers\LaundryVendorController::class, 'process'])->name('laundry_vendor.process');

    // forum
    Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum-admin', [App\Http\Controllers\ForumController::class, 'admin_forum'])->name('forum.admin_forum');
    Route::get('/forum/create', [App\Http\Controllers\ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum', [App\Http\Controllers\ForumController::class, 'store'])->name('forum.store');
    Route::get('/forum/{id}/like', [App\Http\Controllers\ForumController::class, 'like'])->name('forum.like');

    // Storage
    Route::get('/storages', [App\Http\Controllers\StoragesController::class, 'index'])->name('storages.index');
    Route::get('/storages/create', [App\Http\Controllers\StoragesController::class, 'create'])->name('storages.create');
    Route::post('/storages', [App\Http\Controllers\StoragesController::class, 'store'])->name('storages.store');
    Route::get('/storages/{id}/edit', [App\Http\Controllers\StoragesController::class, 'edit'])->name('storages.edit');
    Route::put('/storages/{id}', [App\Http\Controllers\StoragesController::class, 'update'])->name('storages.update');
    Route::delete('/storages/{id}', [App\Http\Controllers\StoragesController::class, 'destroy'])->name('storages.destroy');

    // roomates
    Route::get('/roommates', [App\Http\Controllers\RoomateController::class, 'index'])->name('roommates.index');
    Route::get('/roommates/create', [App\Http\Controllers\RoomateController::class, 'create'])->name('roommates.create');
    Route::post('/roommates', [App\Http\Controllers\RoomateController::class, 'store'])->name('roommates.store');
    Route::post('/roommates/{id}/request', [App\Http\Controllers\RoomateController::class, 'roomates'])->name('roommates.request');
    Route::get('/roommates/request', [App\Http\Controllers\RoomateController::class, 'show'])->name('roommates.show');
    Route::get('/roommates/{id}/details', [App\Http\Controllers\RoomateController::class, 'details'])->name('roommates.details');
    Route::post('/roommates/{id}/store_details', [App\Http\Controllers\RoomateController::class, 'store_details'])->name('roommates.store_details');
    Route::get('/roommates/{id}/decline', [App\Http\Controllers\RoomateController::class, 'reject'])->name('roommates.reject');

    // laundry
    Route::get('/laundries', [App\Http\Controllers\LaundryController::class, 'index'])->name('laundries.index');
    Route::get('/laundries/vendor-to-admin', [App\Http\Controllers\LaundryController::class, 'vendortoadmin'])->name('laundries.vendortoadmin');
    Route::get('/laundries/history', [App\Http\Controllers\LaundryController::class, 'history'])->name('laundries.history');
    Route::get('/laundries/create', [App\Http\Controllers\LaundryController::class, 'create'])->name('laundries.create');
    Route::post('/bridge', [App\Http\Controllers\LaundryController::class, 'bridge'])->name('laundries.bridge');
    Route::get('/laundries/transaction', [App\Http\Controllers\LaundryController::class, 'transaction'])->name('laundries.transaction');
    Route::post('/laundries', [App\Http\Controllers\LaundryController::class, 'store'])->name('laundries.store');
    Route::get('/laundries/{id}/edit', [App\Http\Controllers\LaundryController::class, 'edit'])->name('laundries.edit');
    Route::put('/laundries/{id}', [App\Http\Controllers\LaundryController::class, 'update'])->name('laundries.update');
    Route::delete('/laundries/{id}', [App\Http\Controllers\LaundryController::class, 'destroy'])->name('laundries.destroy');
    Route::get('/laundries/{id}/taked', [App\Http\Controllers\LaundryController::class, 'taked'])->name('laundries.taked');
    Route::get('/laundries/{id}/done', [App\Http\Controllers\LaundryController::class, 'done'])->name('laundries.done');

    // rooms
    Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'index'])->name('rooms.index');
    Route::get('/rooms/create', [App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
    Route::post('/rooms', [App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms/history', [App\Http\Controllers\RoomController::class, 'history'])->name('rooms.history');
    Route::get('/rooms/{id}/edit', [App\Http\Controllers\RoomController::class, 'edit'])->name('rooms.edit');
    Route::put('/rooms/{id}', [App\Http\Controllers\RoomController::class, 'update'])->name('rooms.update');
    Route::delete('/rooms/{id}', [App\Http\Controllers\RoomController::class, 'destroy'])->name('rooms.destroy');

    //broadcast
    Route::get('/broadcast',[App\Http\Controllers\BroadcastController::class, 'index'])->name('broadcast.index');
    Route::get('/broadcast/create',[App\Http\Controllers\BroadcastController::class, 'create'])->name('broadcast.create');
    Route::post('/broadcast',[App\Http\Controllers\BroadcastController::class, 'store'])->name('broadcast.store'); 
    Route::delete('/broadcast/{id}',[App\Http\Controllers\BroadcastController::class, 'destroy'])->name('broadcast.destroy');
});
