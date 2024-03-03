<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;

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

// Auth::routes();
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/companies', CompanyController::class);
Route::resource('/employees', EmployeeController::class);

//queue and jobs use
Route::get('/send-email', [CompanyController::class, 'testSendEmailBulk']);
//or
// Route::get('/send-mail-post-create',function(){
//      $data['email'][] = 'martinhen737@gmail.com';
//      $data['email'][] = 'baghel083@gmail.com';
//      dispatch(new App\Jobs\SendEmailPostJob($data));
//      dd($data['email']);
//      dd('send mail');
// });


