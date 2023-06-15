<?php

use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Employer\HomeController;
use App\Http\Controllers\Employer\NewEmployerController;
use App\Http\Controllers\Employer\PackageController;
use App\Http\Controllers\Employer\ProfileCompanyController;
use App\Http\Controllers\Employer\ProfileEmployerController;
use App\Http\Controllers\Employer\SearchCvController;
use App\Http\Controllers\HomeController as ControllersHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Seeker\ManageController;
use App\Http\Controllers\Seeker\ProfileController;
use Illuminate\Support\Facades\Route;

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
// home
Route::get('/', [ControllersHomeController::class, 'index'])->name('home');
Route::prefix('viec-lam')->name('client.')->group(function () {
    Route::get('/{slug}.{id}', [ControllersHomeController::class, 'detail'])->name('detail');
    Route::post('/up-cv', [ControllersHomeController::class, 'upCv'])->name('upcv');
    // love cv
    Route::get('/favourite-love/{id}', [ControllersHomeController::class, 'getDatalove']); // api
    Route::post('/favourite/{id}', [ControllersHomeController::class, 'userFavouriteId']); // api
});
// ứng viên

// client company
Route::prefix('cong-ty')->name('company.')->group(function () {
    Route::get('/{slug}', [CompanyController::class, 'detail'])->name('detail');
    Route::get('/', [CompanyController::class, 'index'])->name('index');
});

// home page
Route::get('/search', [ControllersHomeController::class, 'search'])->name('home.search');

// client user
Route::prefix('users')->name('users.')->group(function () {
    Route::resource('login', LoginController::class);
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{slug}', [ProfileController::class, 'index'])->name('index');
    });
    Route::resource('file', ManageController::class);
    Route::prefix('file')->name('file.')->group(function () {
        Route::get('destroy/{id}', [ManageController::class, 'destroy'])->name('destroy');
    });
    Route::get('apply', [ManageController::class, 'apply'])->name('apply');
    Route::get('love', [ManageController::class, 'love'])->name('love');
});

// logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// ntd 
Route::prefix('employers')->name('employer.')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');
    Route::resource('/new', NewEmployerController::class);
    Route::prefix('/new')->name('new.')->group(function () {
        Route::post('/update/{id}', [NewEmployerController::class, 'update'])->name('update');
        Route::get('/{id}', [NewEmployerController::class, 'destroy'])->name('destroy');
    });
    // 
    Route::resource('/package', PackageController::class);
    Route::resource('/profile', ProfileEmployerController::class);
    Route::resource('/company', ProfileCompanyController::class);
    Route::prefix('/package')->name('package.')->group(function () {
        Route::post('/payment', [PackageController::class, 'payment'])->name('payment');
        Route::get('package/payment/return', [PackageController::class, 'vnpayReturn'])->name('payment.return');
    });
    // search cv
    Route::get('search-cv',[SearchCvController::class,'index'])->name('search.cv');
    Route::get('cv-bought',[SearchCvController::class,'showCvBought'])->name('cvbought');
});
