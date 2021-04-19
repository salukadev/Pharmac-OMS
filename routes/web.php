<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProductRequestController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecurringOrderController;
use App\Http\Controllers\SupplierController;

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

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'authenticate']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    //return view('welcome');
    return Inertia::render('Store/Main',[
        'version' => 'V0.91'
    ]);

})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Home');
});

Route::get('/register', function () {
    return Inertia::render('Register',[]);
});

//Route::get('/list', function () {
//    return Inertia::render('List',[]);
//});
Route::resource('orders', OrderController::class);

//Agent Routes

Route::get('/agentDetails', [AgentController::class, 'index'])->name('Agent.index');
Route::get('/agentDetails/add', [AgentController::class, 'create']);
Route::post('/agentDetails/store', [AgentController::class, 'store']);
Route::post('/agentDetails/edit', [AgentController::class, 'edit'])->name('Agent.edit');
Route::post('/agentDetails/update',[AgentController::class, 'update']);
Route::post('/agentDetails/delete/{id}', [AgentController::class, 'destroy']);

//Stock
Route::get('/stock', [StockController::class, 'index'])->name('Stock.index');
Route::get('/stock/add', [StockController::class, 'create']);
Route::post('/stock/store', [StockController::class, 'store']);
Route::post('/stock/edit', [StockController::class, 'edit'])->name('Stock.edit');
Route::post('/stock/update',[StockController::class, 'update']);
Route::post('/stock/delete/{id}', [StockController::class, 'destroy']);

//Category
Route::get('/category', [CategoryController::class, 'index'])->name('Category.index');
Route::get('/category/add', [CategoryController::class, 'create']);
Route::post('/category/store', [CategoryController::class, 'store']);
Route::post('/category/edit', [CategoryController::class, 'edit'])->name('Category.edit');
Route::post('/category/update',[CategoryController::class, 'update']);
Route::post('/category/delete/{id}', [CategoryController::class, 'destroy']);
//Product requests routes

Route::get('/productRequestsAll', [ProductRequestController::class, 'index'])->name('ProductRequest.index');
Route::post('/productRequest/store',[ProductRequestController::class, 'store']);
Route::get('/productRequest/add', [ProductRequestController::class,'create']);
Route::post('/productRequest/delete/{id}', [ProductRequestController::class,'destroy']);

//Recurring orders
Route::get('/recurringorder',[RecurringOrderController::class, 'index']);
Route::post('/recurringorder/cancel/{id}', [RecurringOrderController::class, 'destroy']);
Route::post('/recurringorder/create', [RecurringOrderController::class, 'store']);
Route::post('/recurringorder/update', [RecurringOrderController::class, 'update']);
Route::post('/order/edit', [OrderController::class, 'edit']);

Route::post('/order/update', [OrderController::class, 'update']);


Route::get('/list', function () {
    return Inertia::render('List',[]);
});

//product listing
Route::get('/list',[ProductListController::class,'display']);

Route::get('product/create',[ProductListController::class,'create']);

Route::post('/add',[ProductListController::class,'add']);

Route::post('/deleteProduct/{id}',[ProductListController::class,'deleteProduct']);

Route::post('/editProduct/',[ProductListController::class,'edit']);

Route::post('/updateProducts',[ProductListController::class,'update']);




/*
###############################
       Supplier Routes
###############################
*/

Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier/store',[SupplierController::class,'store']);
Route::get('/sup', function () {return Inertia::render('Admin/Supplier/test',[]); });




/*
###############################
       Returns Routes
###############################
*/
Route::get('/returns',[ProductReturnController::class,'index']);

Route::get('/return_request', function () {return Inertia::render('Client/Return/ReturnRequest',[]); });
Route::post('/return_request',[ProductReturnController::class,'store']);
