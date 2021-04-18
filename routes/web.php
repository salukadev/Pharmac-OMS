<?php

use App\Http\Controllers\ComplaintsController;   
use Illuminate\Support\Facades\Route;
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


Route::get('/clientRequest', function () {
    return Inertia::render('ClientRequest/ClientRequest',[]);
});

Route::get('/complaint',[ComplaintsController::class,'display'])->name('displayComplaint');
Route::get('/create',[ComplaintsController::class,'create'])->name('createComplaint');
Route::post('/add',[ComplaintsController::class,'add']);  

Route::post('/editComplaint',[ComplaintsController::class,'edit']);
Route::post('/updateComplaint',[ComplaintsController::class,'update']);
Route::post('/deleteComplaint/{id}',[ComplaintsController::class,'deleteComplaint']);

Route::post('/client_register',[ClientRequestController::class,'create']);
Route::post('/client_register',[ClientRequestController::class,'create']);