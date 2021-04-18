<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductReturnController;

use Inertia\Inertia;

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
    //return view('welcome');

    return Inertia::render('Home',[
        'version' => 'V0.91'
    ]);
});

Route::get('/register', function () {
    return Inertia::render('Register',[]);
});

Route::get('/return', function () {
    return Inertia::render('Return',[]);
});


/*
Route::get('/supplier', function () {
    return Inertia::render('Supplier',[]);
});*/

Route::get('/supplier', [SupplierController::class, 'index']);

Route::get('/add', function () {
    return Inertia::render('Supplier/AddSup',[]);
});



/*
###############################
       Supplier Routes
###############################
*/

Route::get('/supplier', [SupplierController::class, 'index']);


Route::post('/supplier',[SupplierController::class,'store']);




/*
###############################
       Returns Routes
###############################
*/
Route::get('/returns',[ProductReturnController::class,'index']);

Route::get('/return_request', function () {return Inertia::render('ProductReturn/ProductReturnReq',[]); });
Route::post('/return_request',[ProductReturnController::class,'store']);

