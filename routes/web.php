<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

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

Route::get('/',[HomeController::class,'index']);
Route::get('/home',[HomeController::class,'redirect']);
       //->middleware('auth','verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});




Route::post('/appointment',[HomeController::class,'appointment']);
Route::get('/myappointment',[HomeController::class,'myappointment']);
Route::get('/cancel/{id}',[HomeController::class,'cancel']);


Route::middleware('admin')->group(function () {
    Route::get('/add_doctor_view',[AdminController::class,'addview']);
    Route::post('/upload_doctor',[AdminController::class,'upload']);

    Route::get('/showappointment',[AdminController::class,'showappointment']);
    Route::get('/approved/{id}',[AdminController::class,'approved']);
    Route::get('/canceled/{id}',[AdminController::class,'canceled']);

    Route::get('/showdoctor',[AdminController::class,'showdoctor']);
    Route::get('/deletedoctor/{id}',[AdminController::class,'deletedoctor']);
    Route::get('/editdoctor/{id}',[AdminController::class,'editdoctor']);
    Route::put('/updatedoctor/{id}',[AdminController::class,'updatedoctor']);

    Route::get('/emailview/{id}',[AdminController::class,'emailview']);
    Route::post('/sendemail/{id}',[AdminController::class,'sendemail']);
});



