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


// Verification WA
Route::get('/verification', [App\Http\Controllers\VerficationPhonesController::class, 'index'])->name('verification.index');
Route::post('/verification', [App\Http\Controllers\VerficationPhonesController::class, 'store'])->name('verification.store');
Route::get('/verification/resend', [App\Http\Controllers\VerficationPhonesController::class, 'resend'])->name('verification.resend');
Route::get('/verification/inputnewphone', [App\Http\Controllers\VerficationPhonesController::class, 'inputnewphone'])->name('verification.inputnewphone');
Route::post('/verification/inputnewphone', [App\Http\Controllers\VerficationPhonesController::class, 'storenewphone'])->name('verification.storenewphone');

Route::group(['middleware' => 'auth'], function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
    
    Route::group(['middleware' => 'user'], function () {
        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
        Route::get('/financial', [App\Http\Controllers\UserController::class, 'financial_index'])->name('user.financial');
        Route::get('/financial/{id}', [App\Http\Controllers\UserController::class, 'financial_show'])->name('user.financial_show');
        // shopping
        Route::get('/shop', [App\Http\Controllers\ShopController::class, 'index'])->name('shop');
        Route::get('/shop/addtocart/{id}/{name}/{price}', [App\Http\Controllers\ShopController::class, 'addToCart'])->name('addtocart');
        Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');
        Route::get('/cart/incqty/{rowId}', [App\Http\Controllers\CartController::class, 'incQty'])->name('incqty');
        Route::get('/cart/decqty/{rowId}', [App\Http\Controllers\CartController::class, 'decQty'])->name('decqty');
        Route::get('/cart/changeqty/{rowId}/{qty}', [App\Http\Controllers\CartController::class, 'changeQty'])->name('changeqty');
        Route::get('/cart/delitm/{rowId}', [App\Http\Controllers\CartController::class, 'delItem'])->name('delitm');
        Route::post('/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('checkout');
        Route::get('/checkout/{id}', [App\Http\Controllers\CartController::class, 'toPay'])->name('toPay');
        Route::get('/checkout/callback', [App\Http\Controllers\CartController::class, 'callback'])->name('callback');
        Route::get('/history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history');
        Route::get('/history/delhistory/{id}', [App\Http\Controllers\HistoryController::class, 'delHistory'])->name('history.del');
        Route::post('/history/renamehistory/{id}', [App\Http\Controllers\HistoryController::class, 'renameHistory'])->name('history.confirmRename');


        // laundry history for user
        Route::get('/user/laundry', [App\Http\Controllers\UserController::class, 'laundry_status'])->name('user.laundry_status');

        // forum
        Route::get('/forum', [App\Http\Controllers\ForumController::class, 'index'])->name('forum.index');
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

        //roommates
        Route::get('/roommates', [App\Http\Controllers\RoomateController::class, 'index'])->name('roommates.index');
        Route::get('/roommates/create', [App\Http\Controllers\RoomateController::class, 'create'])->name('roommates.create');
        Route::post('/roommates', [App\Http\Controllers\RoomateController::class, 'store'])->name('roommates.store');
        Route::post('/roommates/{id}/request', [App\Http\Controllers\RoomateController::class, 'roomates'])->name('roommates.request');
        Route::get('/roommates/{id}/accept', [App\Http\Controllers\RoomateController::class, 'userAccept'])->name('roommates.userAccept');

        //complain
        Route::get('/complains', [App\Http\Controllers\ComplainController::class, 'index'])->name('complains.index');
        Route::get('/complains/create', [App\Http\Controllers\ComplainController::class, 'create'])->name('complains.create');
        Route::get('/complains/laundry', [App\Http\Controllers\ComplainController::class, 'laundry'])->name('complains.laundry');
        Route::post('/complains', [App\Http\Controllers\ComplainController::class, 'store'])->name('complains.store');
    });

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');

        // forum
        Route::get('/forum-admin', [App\Http\Controllers\ForumController::class, 'admin_forum'])->name('forum.admin_forum');


        // roomates
        Route::get('/roommates/request', [App\Http\Controllers\RoomateController::class, 'show'])->name('roommates.show');
        Route::get('/roommates/{id}/details', [App\Http\Controllers\RoomateController::class, 'details'])->name('roommates.details');
        Route::post('/roommates/{id}/store_details', [App\Http\Controllers\RoomateController::class, 'store_details'])->name('roommates.store_details');

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

        //addvendor
        Route::get('/laundries/vendor', [App\Http\Controllers\LaundryController::class, 'vendor_index'])->name('laundries.vendor');
        Route::get('/laundries/addvendor', [App\Http\Controllers\LaundryController::class, 'addVendor'])->name('laundries.addVendor');
        Route::post('/laundries/storevendor', [App\Http\Controllers\LaundryController::class, 'storeVendor'])->name('laundries.storeVendor');
        Route::get('/laundries/{id}/editvendor', [App\Http\Controllers\LaundryController::class, 'editVendor'])->name('laundries.editVendor');
        Route::put('/laundries/{id}/updatevendor', [App\Http\Controllers\LaundryController::class, 'updateVendor'])->name('laundries.updateVendor');
        Route::delete('/laundries/{id}/deletevendor', [App\Http\Controllers\LaundryController::class, 'deleteVendor'])->name('laundries.deleteVendor');
        Route::get('/laundries/{id}/showcomplain', [App\Http\Controllers\LaundryController::class, 'showComplain'])->name('laundries.showComplain');

        // rooms
        Route::get('/rooms', [App\Http\Controllers\RoomController::class, 'index'])->name('rooms.index');
        Route::get('/rooms/create', [App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
        Route::post('/rooms', [App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
        Route::get('/rooms/history', [App\Http\Controllers\RoomController::class, 'history'])->name('rooms.history');
        Route::get('/rooms/{id}/edit', [App\Http\Controllers\RoomController::class, 'edit'])->name('rooms.edit');
        Route::put('/rooms/{id}', [App\Http\Controllers\RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/rooms/{id}', [App\Http\Controllers\RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::delete('/rooms/{id}/delete', [App\Http\Controllers\RoomController::class, 'delete'])->name('rooms.delete');

        //broadcast
        Route::get('/broadcast',[App\Http\Controllers\BroadcastController::class, 'index'])->name('broadcast.index');
        Route::get('/broadcast/create',[App\Http\Controllers\BroadcastController::class, 'create'])->name('broadcast.create');
        Route::post('/broadcast',[App\Http\Controllers\BroadcastController::class, 'store'])->name('broadcast.store'); 
        Route::delete('/broadcast/{id}',[App\Http\Controllers\BroadcastController::class, 'destroy'])->name('broadcast.destroy');

        //class
        Route::get('/classes', [App\Http\Controllers\ClassController::class, 'index'])->name('class.index');
        Route::get('/classes/create', [App\Http\Controllers\ClassController::class, 'create'])->name('class.create');
        Route::post('/classes', [App\Http\Controllers\ClassController::class, 'store'])->name('class.store');
        Route::get('/classes/{id}/edit', [App\Http\Controllers\ClassController::class, 'edit'])->name('class.edit');
        Route::put('/classes/{id}', [App\Http\Controllers\ClassController::class, 'update'])->name('class.update');
        Route::get('/classes/{id}/status', [App\Http\Controllers\ClassController::class, 'status'])->name('class.status');
        Route::delete('/classes/{id}', [App\Http\Controllers\ClassController::class, 'destroy'])->name('class.destroy');

        //products
        Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{id}/edit', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/cart/toTake', [App\Http\Controllers\CartController::class, 'toTake'])->name('toTake');
        Route::get('/cart/toTake/{id}', [App\Http\Controllers\CartController::class, 'toTakeOrder'])->name('toTakeOrder');


        Route::get('/admin/financials', [App\Http\Controllers\AdminController::class, 'financials'])->name('admin.financials');
    });

    Route::group(['middleware' => 'vendor'],function(){
        // laundry_vendor
        Route::get('/laundry_vendor', [App\Http\Controllers\LaundryVendorController::class, 'dashboard'])->name('laundry_vendor.dashboard');
        Route::get('/laundry_vendor/laundry', [App\Http\Controllers\LaundryVendorController::class, 'index'])->name('laundry_vendor.index');
        Route::get('/laundry_vendor/laundry/transactionforadmin', [App\Http\Controllers\LaundryVendorController::class, 'transactionforadmin'])->name('laundry_vendor.transactionforadmin');
        Route::get('/laundry_vendor/laundry/{id}/edit', [App\Http\Controllers\LaundryVendorController::class, 'edit'])->name('laundry_vendor.edit');
        Route::put('/laundry_vendor/laundry/{id}', [App\Http\Controllers\LaundryVendorController::class, 'update'])->name('laundry_vendor.update');
        Route::get('/laundry_vendor/history', [App\Http\Controllers\LaundryVendorController::class, 'history'])->name('laundry_vendor.history');
        Route::get('/laundry_vendor/laundry/{id}/done', [App\Http\Controllers\LaundryVendorController::class, 'done'])->name('laundry_vendor.done');
        Route::get('/laundry_vendor/laundry/{id}/process', [App\Http\Controllers\LaundryVendorController::class, 'process'])->name('laundry_vendor.process');

        Route::get('/vendor/financials', [App\Http\Controllers\LaundryVendorController::class, 'financials'])->name('vendor.financials');

    });
 
    // complain 
    Route::get('/complains/show', [App\Http\Controllers\ComplainController::class, 'show'])->name('complains.show');
    Route::get('/complains/proceed/{id}', [App\Http\Controllers\ComplainController::class, 'adminProceed'])->name('complains.adminProceed');
    Route::get('/complains/finish/{id}', [App\Http\Controllers\ComplainController::class, 'adminFinish'])->name('complains.adminFinish');

    Route::get('/roommates/{id}/user-decline', [App\Http\Controllers\RoomateController::class, 'userReject'])->name('roommates.user_reject');
    Route::get('/roommates/{id}/decline', [App\Http\Controllers\RoomateController::class, 'reject'])->name('roommates.reject');


});
