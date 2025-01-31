<?php

use App\Http\Controllers\Applications\CategoryShiftingController;
use App\Http\Controllers\Applications\FloorShiftingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HousingFlatController;
use App\Http\Controllers\Applications\NewApplicationController;
use App\Http\Controllers\HrmsDdoController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\MigrateController;
use Illuminate\Support\Facades\Auth;


Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'homePage')->name('homepage');
    Route::get('home', 'index')->name('index');
});

// Migration related routes start here ------
Route::controller(MigrateController::class)->group(function () {
    Route::get('migrate-users', 'migrateUsers')->name('migrateUsers');
});
// Migration related routes end here ------

Auth::routes();

Route::controller(LoginController::class)->name('login.')->group(function () {
    Route::get('site-login', 'showLoginForm')->name('showLoginForm');
    Route::get('refresh-captcha', 'refreshCaptcha')->name('refreshCaptcha');
    Route::post('applicant-login', 'applicantLogin')->name('applicantLogin');
});

// Authenticated Routes start here ------
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(MasterController::class)->name('master.')->group(function () {
        Route::get('flat-type', 'getFlatType')->name('flatType');
        Route::get('get-estate-preference', 'getEstatePreference')->name('getEstatePreference');
    });

    Route::middleware(['role:applicant'])->group(function () {
        // All Applications Routes start here ------
        Route::controller(NewApplicationController::class)
            ->middleware(['check.applied'])
            ->name('hrms.')
            ->group(function () {
                Route::get('applications/new-application', 'create')->name('create');
                Route::post('new-application', 'store')->name('store');
                Route::get('applications/view-application', 'view')->name('view');
            });

        Route::controller(CategoryShiftingController::class)->name('cs.')->group(function () {
            Route::get('applications/category-shifting', 'create')->name('create');
            Route::post('cs', 'store')->name('store');
        });

        Route::controller(FloorShiftingController::class)->name('vs.')->group(function () {
            Route::get('applications/floor-shifting', 'create')->name('create');
            Route::post('vs', 'store')->name('store');
        });
        // All Applications Routes end here ------
    });
});
// Authenticated Routes end here ------

Route::controller(HrmsDdoController::class)->name('ddo.')->group(function () {
    Route::get('ddo-designations', 'ddoDesignations')->name('designations');
});

// For Housing Flat Addition
Route::get('housing-flat-add', [HousingFlatController::class, 'housingFlatAdd']);
Route::post('store-flat-info', [HousingFlatController::class, 'housingFlatStore']);

// For Flat List View from Flat Master Table
//Route::get('rhe-flat-update', [HousingFlatUpdateController::class, 'housingFlatUpdate']);

// For RHE-Wise Flat List Edit
Route::get('housing-flat-edit', [HousingFlatController::class, 'HousingFlatEdit']);
Route::post('housing-flat-get-flat-type', [HousingFlatController::class, 'getFlatType']);
Route::post('housing-flat-get-flat-block', [HousingFlatController::class, 'getFlatBlock']);
Route::get('housing-flat-edit-save', [HousingFlatController::class, 'HousingFlatEditSave']);
Route::get('housing-flat-list-view', [HousingFlatController::class, 'getFlatListView']);
