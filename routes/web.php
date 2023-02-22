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

Route::get('/companies', [CompanyController::class, 'getAllCompany']);
Route::view('/companies/register', 'register');
Route::post('/companies/register', [CompanyController::class, 'store']);
Route::post('/companies/delete', [CompanyController::class, 'delete']);
Route::get('/companies/{id}', [CompanyController::class, 'edit']);
Route::post('/companies/{id}', [CompanyController::class, 'update']);
