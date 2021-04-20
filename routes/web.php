<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductReturnController;

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

Route::resource('orders', OrderController::class);

//Agent Routes

Route::get('/agentDetails', [AgentController::class, 'index'])->name('Agent.index');
Route::get('/agentDetails/add', [AgentController::class, 'create']);
Route::post('/agentDetails/store', [AgentController::class, 'store']);
Route::post('/agentDetails/edit', [AgentController::class, 'edit'])->name('Agent.edit');
Route::post('/agentDetails/update',[AgentController::class, 'update']);
Route::post('/agentDetails/delete/{id}', [AgentController::class, 'destroy']);


/*
###############################
       Supplier Routes
###############################
*/

Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier/store',[SupplierController::class,'store']);
Route::post('/supplier/update',[SupplierController::class,'update']);
Route::get('/sup', function () {return Inertia::render('Admin/Supplier/test',[]); });
Route::get('/supplier/edit', function () {return Inertia::render('Admin/Supplier/SupplierEdit',[]); });




/*
###############################
       Returns Routes
###############################
*/
Route::get('/returns',[ProductReturnController::class,'index']);
Route::get('/return/store', function () {return Inertia::render('Client/Return/ReturnRequestAdd',[]); });
Route::post('/return/store',[ProductReturnController::class,'store']);
