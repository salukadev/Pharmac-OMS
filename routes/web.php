<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProductListController;

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

Route::get('/list', function () {
    return Inertia::render('List',[]);
});


Route::get('/list',[ProductListController::class,'display']);

Route::get('product/create',[ProductListController::class,'create']);

Route::post('/add',[ProductListController::class,'add']);

Route::post('/update',[ProductListController::class,'edit']);

//Route::get('product/create',[ProductListController::class,'create']);
//
//Route::post('/list',[ProductListController::class,'create']);
//Route::get('product/create', function () {
//    return Inertia::render('AddNew',[]);
//});
