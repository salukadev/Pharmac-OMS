<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\ClientRequestController;

use App\Http\Controllers\Customer1Controller;
use App\Http\Controllers\RegistrationRequestController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProductRequestController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ComplaintsController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecurringOrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductReturnController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DeletedChequeController;
use App\Http\Controllers\ChequeController;


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
Route::get('/financial/dashboard',[ChartController::class,'incomeChart']);

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
    return Inertia::render('FinancialDashboard');
});

Route::get('/userProfile', function () {
    return Inertia::render('UserProfile');
});


Route::get('/dashboard/Admin', [ChartController::class, 'incomeChartHome']);

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
Route::post('/productRequest/storeRequest',[ProductRequestController::class, 'storeClientRequest']);
Route::get('/productRequest/add', [ProductRequestController::class,'create']);
Route::post('/productRequest/delete/{id}', [ProductRequestController::class,'destroy']);

//Recurring orders
Route::get('/recurringorder',[RecurringOrderController::class, 'index']);
Route::post('/recurringorder/cancel/{id}', [RecurringOrderController::class, 'destroy']);
Route::post('/recurringorder/create', [RecurringOrderController::class, 'store']);
Route::patch('/recurringorder/update', [RecurringOrderController::class, 'update']);
Route::post('/order/edit', [OrderController::class, 'edit']);

Route::post('/order/update', [OrderController::class, 'update']);
Route::get('/order/{id}', [OrderController::class, 'show']);


Route::get('/list', function () {
    return Inertia::render('List',[]);
});

Route::get('/discount/Plans',function (){
   return Inertia::render('DiscountPlanList',[]);
});

//product listing
Route::get('/list',[ProductListController::class,'display'])->name('ProductDisplay');

Route::get('product/create',[ProductListController::class,'create']);

Route::post('/add',[ProductListController::class,'add']);

Route::post('/deleteProduct/{id}',[ProductListController::class,'deleteProduct']);

Route::post('/editProduct',[ProductListController::class,'edit']);

Route::post('/updateProducts',[ProductListController::class,'update']);


//Discount
Route::get('/discount',[DiscountController::class,'display'])->name('displayDiscount');
Route::get('discount/create',[DiscountController::class,'create']);
Route::post('/discount/add',[DiscountController::class,'add']);
Route::post('/editDiscount',[DiscountController::class,'edit']);
Route::post('/discount/update',[DiscountController::class,'update']);
Route::post('/deleteDiscount/{id}',[DiscountController::class,'delete']);




/*
###############################
       Supplier Routes
###############################
*/

Route::get('/supplier', [SupplierController::class, 'index']);
Route::post('/supplier/store',[SupplierController::class,'store']);
Route::post('/supplier/update',[SupplierController::class,'update']);
Route::post('/supplier/delete/{id}',[SupplierController::class,'destroy']);
Route::get('/sup', function () {return Inertia::render('Admin/Supplier/test',[]); });
//Route::get('/supplier/edit', function () {return Inertia::render('Admin/Supplier/SupplierEdit',[]); });




/*
###############################
       Returns Routes
###############################
*/
Route::get('/returns',[ProductReturnController::class,'index']);
Route::get('/return/store', function () {return Inertia::render('Client/Return/ReturnRequestAdd',[]); });
Route::post('/return/store',[ProductReturnController::class,'store']);
Route::post('/return/update',[ProductReturnController::class,'update']);



/*
###############################
       Delivery Routes
###############################
*/
Route::get('/delivery',[DeliveryController::class,'index']);
Route::post('/delivery/update',[DeliveryController::class,'update']);



Route::get('/upload-Cheques',[ChequeController::class,'create'])->name('cheque.create');
Route::post('Cheques/upload/store',[ChequeController::class,'store']);
Route::get('/ChequesList',[ChequeController::class,'index']);
Route::get('/pending-Cheques',[ChequeController::class,'pending'])->name('cheques-pending');
Route::put('Cheque/approve/{id}',[ChequeController::class,'approveCheque']);
Route::put('Cheque/reject/{id}',[ChequeController::class,'rejectCheque']);
Route::get('Cheque/{id}',[ChequeController::class,'show']);
Route::post('Cheque/update',[ChequeController::class,'update']);
Route::post('Cheque/delete',[ChequeController::class,'destroy']);


Route::get('/deleted-cheques',[DeletedChequeController::class,'index']);
Route::get('/clientRequest', function () {
    return Inertia::render('ClientRequest/ClientRequest',[]);
});

//complaint routes

Route::get('/complaint',[ComplaintsController::class,'display'])->name('displayComplaint');
Route::get('/create',[ComplaintsController::class,'create'])->name('createComplaint');
Route::post('/add',[ComplaintsController::class,'add']);
Route::post('/addComplaint',[ComplaintsController::class,'add']);

Route::post('/editComplaint',[ComplaintsController::class,'edit']);
Route::post('/updateComplaint',[ComplaintsController::class,'update']);
Route::post('/deleteComplaint/{id}',[ComplaintsController::class,'deleteComplaint']);




//client_registration requests

Route::get('/client_reg_request',[RegistrationRequestController::class,'display'])->name('displayRequest');
Route::get('/create_request',[RegistrationRequestController::class,'create']);
Route::post('/add',[RegistrationRequestController::class,'add']);
Route::post('/editRegistrationRequest',[RegistrationRequestController::class,'edit']);
Route::post('/updateRegistrationRequest',[RegistrationRequestController::class,'update']);
Route::post('/deleteRegistrationRequest/{requestId}',[RegistrationRequestController::class,'deleteRegistrationRequest']);
Route::get('/displayCustomers',[RegistrationRequestController::class,'displaycustomer']);



//customer_registration
//Route::get('/displayCustomersAll',[CustomerController::class,'display'])->name('display');
//Route::get('/editcustomerDetails',[CustomerController::class,'edit']);
//Route::get('/createcustomerDetails',[CustomerController::class,'create']);
//Route::post('/deleteCustomerDetails/{id}',[CustomerController::class,'deleteCustomerDetails']);


///customer1
Route::get('/CustomerDetails', [Customer1Controller::class, 'index'])->name('Customer.index');
Route::get('/CustomerDetails/add', [Customer1Controller::class, 'create']);
Route::post('/CustomerDetails/store', [Customer1Controller::class, 'store']);
Route::post('/CustomerDetails/edit', [Customer1Controller::class, 'edit'])->name('Customer.edit');
Route::post('/CustomerDetails/update',[Customer1Controller::class, 'update']);
Route::post('/CustomerDetails/delete/{id}', [Customer1Controller::class, 'destroy']);


//Storefront routes

Route::get('/store', [ProductListController::class,'getProducts']);     //show items
Route::get('/store/cart', [CartController::class,'index']);            //show cart
Route::get('/store/cart/list', [CartController::class, 'getItems']); // get cart items for count
Route::post('/store/cart/add', [CartController::class,'addItems']); //  add cart items
Route::post('/store/cart/update', [CartController::class,'updateQuantity']); //update cart item quantity
Route::post('/store/cart/remove', [CartController::class,'removeItems']); // remove cart elements
Route::post('/store/cart/clear', [CartController::class, 'createOrder']); // remove cart elements
