<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BookingController;


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
    return view('welcome');
});

//backend routes

Route::get('admin/login', [AdminController::class, 'adminLoginForm'])->name('admin.login.form');
Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('admin.login');


Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard', [DashboardController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');

    //RoomType Routes
    Route::get('admin/roomtype/{id}/delete', [RoomtypeController::class, 'destroy']);
    Route::resource('admin/roomtype', RoomtypeController::class);

    //Room Routes
    Route::get('admin/rooms/{id}/delete', [RoomController::class, 'destroy']);
    Route::resource('admin/rooms', RoomController::class);

    //Company Routes
    Route::get('admin/company/{id}/delete', [CompanyController::class, 'destroy']);
    Route::resource('admin/company', CompanyController::class);

    //Client Routes
    Route::get('admin/client/{id}/delete', [ClientController::class, 'destroy']);
    Route::resource('admin/client', ClientController::class);

    // Booking
    Route::get('admin/booking/{id}/delete',[BookingController::class,'destroy']);
    Route::get('admin/booking/available-rooms/{checkin_date}',[BookingController::class,'available_rooms']);
    Route::get('admin/booking/total/{company_id}',[BookingController::class,'fetchNumberOfPerson']);
    Route::resource('admin/booking',BookingController::class);

    //Admin Dashboard
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);

    // Route::post('/admin/booking/confirm', [BookingController::class,'confirm'])->name('booking.confirm');
    // Route::post('/admin/booking/store', [BookingController::class,'store'])->name('booking.store');

    Route::get('admin/booking/pdf/{id}', [BookingController::class,'downloadPdf'])->name('booking.pdf');
    Route::get('admin/download', [BookingController::class,'downloadAllBookingsPdf'])->name('test');
    

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
