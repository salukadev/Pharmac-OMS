<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RecurringOrderController;

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

//Recurring orders
Route::get('/recurringorder',[RecurringOrderController::class, 'index']);
Route::post('/recurringorder/cancel/{id}', [RecurringOrderController::class, 'destroy']);
Route::post('/recurringorder/create', [RecurringOrderController::class, 'store']);
Route::post('/recurringorder/update', [RecurringOrderController::class, 'update']);
Route::post('/order/edit', [OrderController::class, 'edit']);

Route::post('/order/update', [OrderController::class, 'update']);


Route::get('/upload',[ChequeController::class,'create'])->name('cheque.create');
Route::post('/upload/store',[ChequeController::class,'store']);
Route::get('/all-cheques',[ChequeController::class,'index']);
Route::get('/pending-cheques',[ChequeController::class,'pending'])->name('cheque.pending');
Route::post('/approve/{id}',[ChequeController::class,'approveCheque'])->name('cheque.approve');
Route::post('/reject/{id}',[ChequeController::class,'rejectCheque'])->name('cheque.reject');
Route::post('cheque',[ChequeController::class,'show'])->name('cheque');

