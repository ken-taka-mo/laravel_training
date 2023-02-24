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
    Route::view('/companies/register', 'register')->name('register');
    Route::post('/companies/delete', 'delete')->name('delete');
    Route::get('/companies/detail/{id}', 'edit')->name('detail');
    Route::post('/companies/detail/{id}', 'update');
    Route::post('/companies/register', 'store');
    Route::get('/companies/{name?}', 'getCompanies')->name('companies');
});
