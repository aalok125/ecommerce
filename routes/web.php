<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\BackendController;
use Illuminate\Support\Facades\View;
use Modules\SiteSetting\Entities\Sitesetting;


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

Route::get('/admin',[AdminController::class, 'index'])->name('dashboard');

Route::get('/register',[BackendController::class, 'register'])->name('register');
Route::post('/registersubmit',[BackendController::class, 'registersubmit'])->name('registersubmit');

Route::get('/',[BackendController::class, 'login'])->name('login');
Route::post('/loginsubmit',[BackendController::class, 'loginsubmit'])->name('loginsubmit');

// View::composer('*', function ($view) {

//     $sitesetting =Sitesetting::where('key','=','site_logo')->first();
//     $sitefavicon = Sitesetting::where('key','=','site_favicon')->first();
//     $view->with('sitesetting',$sitesetting);
//     $view->with('sitefavicon',$sitefavicon);
// });
