<?php

use App\Http\Controllers\AllotmentDetailsController;
use App\Http\Controllers\Applications\CategoryShiftingController;
use App\Http\Controllers\Applications\FloorShiftingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HousingFlatController;
use App\Http\Controllers\Applications\NewApplicationController;
use App\Http\Controllers\ApplicationStatusController;
use App\Http\Controllers\HrmsDdoController;
use App\Http\Controllers\Master\MasterController;
use App\Http\Controllers\MigrateController;
use App\Http\Controllers\Subdiv\OccupantDataController;
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
    Route::get('user/login', 'create')->name('create');
    Route::post('user/login', 'store')->name('store');
    Route::get('site-login', 'showLoginForm')->name('showLoginForm'); // Not using this route
    Route::get('refresh-captcha', 'refreshCaptcha')->name('refreshCaptcha');
    Route::post('applicant-login', 'applicantLogin')->name('applicantLogin');
});

// Authenticated Routes start here ------
Route::middleware(['auth'])->group(function () {
    Route::controller(MasterController::class)->name('master.')->group(function () {
        Route::get('flat-type', 'getFlatType')->name('flatType');
        Route::get('get-estate-preference', 'getEstatePreference')->name('getEstatePreference');
    });

    // Applicant Routes start here ------
    Route::middleware(['role:applicant'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // All Applications Routes start here ------
        Route::controller(NewApplicationController::class)
            ->middleware(['check.applied'])
            ->name('hrms.')
            ->prefix('applications')
            ->group(function () {
                Route::get('new-application', 'create')->name('create');
                Route::post('new-application', 'store')->name('store');
                Route::get('view-application', 'view')->name('view');
            });

        Route::controller(CategoryShiftingController::class)
            ->name('cs.')
            ->prefix('applications')
            ->group(function () {
                Route::get('category-shifting', 'create')->name('create');
                Route::post('cs', 'store')->name('store');
            });

        Route::controller(FloorShiftingController::class)
            ->name('vs.')
            ->prefix('applications')
            ->group(function () {
                Route::get('floor-shifting', 'create')->name('create');
                Route::post('vs', 'store')->name('store');
            });
        // All Applications Routes end here ------

        // Application Status Routes start here ------
        Route::controller(ApplicationStatusController::class)
            ->name('status.')
            ->prefix('status')
            ->group(function () {
                Route::get('application-status', 'applicationStatus')->name('applicationStatus');
                Route::get('wait-list-status', 'waitListStatus')->name('waitListStatus');
            });
        // Application Status Routes end here ------

        // Allotment Details Routes start here ------
        Route::controller(AllotmentDetailsController::class)
            ->name('allotment.')
            ->prefix('allotments')
            ->group(function () {
                Route::get('new-allotment', 'newAllotment')->name('newAllotment');
                Route::get('category-shifting', 'categoryShifting')->name('categoryShifting');
                Route::get('vertical-shifting', 'verticalShifting')->name('verticalShifting');
            });
        // Allotment Details Routes end here ------
    });
    // Applicant Routes end here ------





    // Sub-division Routes start here ------
    Route::middleware(['role:sub-division'])->group(function () {
        Route::get('dashboard/sub-division', [DashboardController::class, 'subdiv'])->name('subdiv.dashboard');

        // Occupant Data Routes start here ------
        Route::controller(OccupantDataController::class)->name('occupant-data.')->group(function () {
            Route::get('occupant-data', 'index')->name('inex');
            Route::get('occupant-data/new', 'create')->name('create');
            Route::post('occupant-data', 'store')->name('store');
            Route::get('occupant-flat-type', 'getOccupantFlatType')->name('occupant.flat.type');
            Route::get('occupant-block', 'getOccupantBlock')->name('occupant.block');
            Route::get('occupant-flat-no', 'getOccupantFlatNo')->name('occupant.flatno');
        });
        // Occupant Data Routes end here ------
    });
    // Sub-division Routes end here ------





    // Division Routes start here ------
    Route::middleware(['role:division'])->group(function () {
        Route::get('dashboard/division', [DashboardController::class, 'division'])->name('division.dashboard');
    });
    // Division Routes end here ------
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
