<?php

use App\Http\Controllers\AgentController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\OrderController;

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

Route::get('/upload',[ChequeController::class,'create'])->name('cheque.create');
Route::post('/upload/store',[ChequeController::class,'store']);
Route::get('/all-cheques',[ChequeController::class,'index']);
Route::get('/pending-cheques',[ChequeController::class,'pending'])->name('cheque.pending');
Route::post('/approve/{id}',[ChequeController::class,'approveCheque'])->name('cheque.approve');
Route::post('/reject/{id}',[ChequeController::class,'rejectCheque'])->name('cheque.reject');
Route::get('/cheque/{id}',[ChequeController::class,'show'])->name('cheque');

