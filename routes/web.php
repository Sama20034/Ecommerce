<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FirstController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\Review;
use Illuminate\Http\Request;
use App\Http\Middleware\AdminMiddleware;
use App\Models\category;
use App\Models\product;
use App\Models\Cart;
use App\Http\Controllers\LocalizationController;
use App\Http\Middleware\Customauth;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\SetLocale;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/', [FirstController::class, 'MainPage']);

Route::get('/product/{catid?}', [FirstController::class, 'GetCategoryProducts']);
Route::get('/category', [FirstController::class, 'GetAllCategorywithProducts']);


Route::get('/addproduct', [ProductController::class, 'AddProduct'])->middleware(Customauth::class);
Route::get('/editproduct/{productid?}', [ProductController::class, 'EditProducts']);
//Route::get('/editproduct/{productid?}', [ProductController::class, 'EditProducts']);


Route::get('/removeproduct/{productid?}', [ProductController::class, 'RemoveProducts']);
Route::post('/storeproduct', [ProductController::class, 'StoreProduct']);

Route::get('/reviews', [Review::class, 'Reviews']);
Route::post('/storeReview', [Review::class, 'storeReview']);
Route::post('/search', [FirstController::class, 'Search']);


Route::get('/ProductsTable', [ProductController::class, 'ProductsTable']);
Route::get('/AddImages/{productid}', [ProductController::class, 'AddImages']);
Route::get('/removeproductimage/{imageid}', [ProductController::class, 'removeproductimage']);
Route::post('/storeproductimage', [ProductController::class, 'storeproductimage']);
Route::get('/productima/{productid}', [ProductController::class, 'productima']);



Route::get('/ordersa', [cartController::class, 'Ordersa'])->middleware('auth');
Route::post('/StoreOrder', [cartController::class, 'StoreOrder']);
Route::get('/cart', [cartController::class, 'cart'])->middleware('auth');
Route::get('/completeorder', [cartController::class, 'completeorder'])->middleware('auth');
Route::get('/Previouseorder', [cartController::class, 'Previouseorder'])->middleware('auth');

//Route::post('/addproducttocart', [CartController::class, 'Addproducttocart']);
Route::get('/addproducttocart/{productid}', function ($productid) {

    $user_id = auth()->user()->id;

    $result = Cart::where('user_id', $user_id)->where("prodcut_id", $productid)->first();

    if ($result) {
        $result->quantity += 1;
        $result->save();

    } else {

        $newcart = new Cart();
        $newcart->prodcut_id = $productid;
        $newcart->user_id = $user_id;
        $newcart->quantity = 1;
        $newcart->save();

    }
    return redirect('/cart');


})->middleware('auth');

Route::get('/removecart/{cartid?}', [cartController::class, 'RemoveCart']);


Route::resource('photos', PhotoController::class);

// routes/web.php

Route::post('/lang', function (Request $request) {

       session()->put('locale', $request->locale);
    

    return redirect()->back();
})->name('setLocale');


Route::get('/admin',function(){

    return "admin panel";
})->middleware(CheckRoleMiddleware::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Route::get('/test', function () {
//     return view('dashboard.dashboard');
// })->name('test');

Route::get('/dashboards', [DashboardController::class, 'index'])->name('dashboard')->middleware(AdminMiddleware::class);


Route::get('/dashboards/addproduct', [DashboardController::class, 'AddProduct'])->middleware(AdminMiddleware::class);
Route::get('/editproducts/{productid?}', [DashboardController::class, 'EditProducts'])->middleware(AdminMiddleware::class);

Route::get('/dashboards/ProductsTables', [DashboardController::class, 'ProductsTable'])->middleware(AdminMiddleware::class);

// Route::middleware(['auth'])->group(function () {
//     Route::resource('users', UserController::class);
//     Route::patch('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus');
// });


Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware(AdminMiddleware::class);
Route::get('users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware(AdminMiddleware::class);
Route::put('users/{id}', [UserController::class, 'update'])->name('users.update')->middleware(AdminMiddleware::class);
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy')->middleware(AdminMiddleware::class);
Route::patch('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggleStatus')->middleware(AdminMiddleware::class);
Route::get('/dashboards/account', [UserController::class, 'account'])->name('account')->middleware(AdminMiddleware::class);
Route::put('/dashboards/account', [UserController::class, 'update'])->name('account.update')->middleware(AdminMiddleware::class);