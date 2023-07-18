<?php

use App\Http\Controllers\Client\CompanyController;
use App\Http\Controllers\Client\EmployerController;
use App\Http\Controllers\Client\MajorsController;
use App\Http\Controllers\Employer\HomeController;
use App\Http\Controllers\Employer\NewEmployerController;
use App\Http\Controllers\Employer\PackageController;
use App\Http\Controllers\Employer\PaymentForEmployerController;
use App\Http\Controllers\Employer\PaymentHistoryController;
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

// xác thực tài khoản
Route::get('xac-thuc-tai-khoan', [LoginController::class, 'activeUser'])->name('activeUser');
//register employer

Route::get('nha-tuyen-dung/dang-ky', [EmployerController::class, 'index'])->name('register');
Route::post('nha-tuyen-dung/dang-ky', [EmployerController::class, 'store'])->name('register.store');

//
Route::prefix('viec-lam')->name('client.')->group(function () {
    Route::get('/{slug}.{id}', [ControllersHomeController::class, 'detail'])->name('detail');
    Route::post('/up-cv', [ControllersHomeController::class, 'upCv'])->name('upcv');
    // love cv
    Route::get('/favourite-love/{id}', [ControllersHomeController::class, 'getDatalove']); // api
    Route::post('/favourite/{id}', [ControllersHomeController::class, 'userFavouriteId']); // api\

    // nganh nghe
    Route::resource('nganh-nghe', MajorsController::class);
});

// client company
Route::prefix('cong-ty')->name('company.')->group(function () {
    Route::get('/{id}', [CompanyController::class, 'detail'])->name('detail');
    Route::get('/', [CompanyController::class, 'index'])->name('index');
});

// search job
Route::get('/search', [ControllersHomeController::class, 'search'])->name('home.search');

// client user
Route::prefix('users')->name('users.')->group(function () {
    Route::resource('login', LoginController::class);
    Route::prefix('login')->name('login.')->group(function () {
        Route::post('/dang-ky', [LoginController::class, 'register'])->name('register');
    });
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/{slug}', [ProfileController::class, 'index'])->name('index');
        Route::post('/on-status-profile', [ProfileController::class, 'onStatus'])->name('onStatus');
        Route::post('/off-status-profile', [ProfileController::class, 'offStatus'])->name('offStatus');
    });
    Route::resource('file', ManageController::class);
    Route::prefix('file')->name('file.')->group(function () {
        Route::get('destroy/{id}', [ManageController::class, 'destroy'])->name('destroy');
        Route::get('/cv/create-cv', [ManageController::class, 'createCv'])->name('createCv');
        Route::post('/cv/create-cv', [ManageController::class, 'createFormCv'])->name('createFormCv');
    });
    Route::get('apply', [ManageController::class, 'apply'])->name('apply');
    Route::get('love', [ManageController::class, 'love'])->name('love');
    Route::prefix('love')->group(function () {
        Route::delete('delete-love-cv', [ManageController::class, 'deleteLoveCv'])->name('deleteLoveCv');
    });
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
        Route::get('change-status-cv/{id}', [NewEmployerController::class, 'changeStatusCv'])->name('changeStatusCv');
        Route::post('update-reason-cv', [NewEmployerController::class, 'reasonCv'])->name('reasonCv');
        Route::get('get-data-reason/{id}', [NewEmployerController::class, 'getDataReason'])->name('getDataReason');
        Route::get('job/top-new', [NewEmployerController::class, 'topNew'])->name('topNew');
        Route::post('job/top-new', [NewEmployerController::class, 'upTopNew'])->name('upTopNew');
        Route::post('job/delete-top-new/{id}', [NewEmployerController::class, 'deleteTopNew'])->name('deleteTopNew');
    });
    // submitted work
    Route::get('submitted-work', [NewEmployerController::class, 'submittedWork'])->name('submittedWork');
    // 
    Route::resource('/package', PackageController::class);
    Route::resource('/profile', ProfileEmployerController::class);
    Route::resource('/company', ProfileCompanyController::class);
    Route::prefix('/company')->name('company.')->group(function () {
        Route::get('new/business', [ProfileCompanyController::class, 'business'])->name('business');
        Route::post('new/business', [ProfileCompanyController::class, 'ImageAccuracy'])->name('ImageAccuracy');
    });
    Route::prefix('/package')->name('package.')->group(function () {
        Route::post('/payment', [PackageController::class, 'payment'])->name('payment');
        Route::get('package/payment/return', [PackageController::class, 'vnpayReturn'])->name('return');
        Route::get('package/payment/output', [PackageController::class, 'vnpayOutput'])->name('output');
    });
    // search cv
    Route::get('search-cv', [SearchCvController::class, 'index'])->name('search.cv');
    Route::get('search-cv/{id}', [SearchCvController::class, 'show'])->name('search.show');
    Route::post('payment-cv', [SearchCvController::class, 'paymentCv'])->name('search.paymentCv');
    Route::post('search-cv/feedback', [SearchCvController::class, 'feedback'])->name('search.feedback');
    Route::get('cv-bought', [SearchCvController::class, 'showCvBought'])->name('cvbought');
    // nap  tiền
    Route::resource('payment-for-emplyer', PaymentForEmployerController::class);
    Route::prefix('/payment-for-emplyer')->name('payment-for-emplyer.')->group(function () {
        Route::get('payment/vnpay-return', [PaymentForEmployerController::class, 'vnpayReturn'])->name('vnpayReturn');
    });
    Route::resource('payment-history', PaymentHistoryController::class);
});
