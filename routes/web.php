<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
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

Route::get('/upload',[ChequeController::class,'create'])->name('cheque.create');
Route::post('/upload/store',[ChequeController::class,'store']);
Route::get('/all-cheques',[ChequeController::class,'index']);
Route::get('/pending-cheques',[ChequeController::class,'pending'])->name('cheques-pending');
Route::put('/approve/{id}',[ChequeController::class,'approveCheque']);
Route::put('/reject/{id}',[ChequeController::class,'rejectCheque']);
Route::get('cheque/{id}',[ChequeController::class,'show']);
Route::post('/update',[ChequeController::class,'update']);
Route::post('/delete',[ChequeController::class,'destroy']);

