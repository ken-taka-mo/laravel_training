<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::controller(CompanyController::class)->group(function () {
    Route::get('/companies/{page?}', 'getCompanies')->where('page', '[1-9]*\d+');
    Route::view('/companies/register', 'register');
    Route::post('/companies/register', 'store');
    Route::post('/companies/delete', 'delete');
    Route::get('/companies/id/{id}', 'edit');
    Route::post('/companies/id/{id}', 'update');
});
