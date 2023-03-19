<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\userController;
use App\Http\Controllers\planController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


Route::get('/not_list', [App\Http\Controllers\orderController::class, 'indexNot'])->middleware('auth');
Route::get('/show_list', [App\Http\Controllers\orderController::class, 'index'])->middleware('auth');
Route::post('/change_date', [App\Http\Controllers\orderController::class, 'changeDate'])->middleware('auth');
Route::get('/createOrder/{id}/{date}', [App\Http\Controllers\orderController::class, 'create'])->middleware('auth');
Route::get('/createOrderD/{id}', [App\Http\Controllers\orderController::class, 'createD'])->middleware('auth');


Route::post('setOrder', [App\Http\Controllers\orderController::class, 'setOrder'])->middleware('auth');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::resource('plan', planController::class)->middleware('auth');
Route::resource('order', orderController::class)->middleware('auth');
Route::resource('user', userController::class)->middleware('auth');

Route::post('setIndex', [App\Http\Controllers\orderController::class, 'setIndex'])->middleware('auth');
Route::post('confirmOrder', [App\Http\Controllers\orderController::class, 'confirmOrder'])->middleware('auth');

Route::get('/searchOrder/{id}', [App\Http\Controllers\orderController::class, 'searchPhone'])->middleware('auth');
Route::get('export-orders', [App\Http\Controllers\orderController::class, 'export'])->middleware('auth');
