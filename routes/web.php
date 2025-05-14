<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\User\UserCatalogueController;
use App\Http\Controllers\Web\User\UserController;
use App\Http\Controllers\Web\Permission\PermissionController;
use App\Http\Controllers\Web\Team\TeamController;
use App\Http\Controllers\Web\Vehicle\VehicleController;
use App\Http\Controllers\Web\Passenger\PassengerController;
use App\Http\Controllers\Web\Cargo\CargoController;
use App\Http\Controllers\Web\Risk\RiskController;
use App\Http\Controllers\Web\Tax\TaxController;
use App\Http\Controllers\Web\Consultation\ConsultationController;
use App\Http\Controllers\Web\Check\CheckController;
use App\Http\Controllers\Web\Digital\DigitalController;
use App\Http\Controllers\Web\Other\OtherController;
use App\Http\Controllers\Web\Violation\ViolationController;
use App\Http\Controllers\Web\Merchandise\MerchandiseController;
use App\Http\Controllers\Web\Unit\UnitController;
use App\Http\Controllers\Web\Ajax\DashboardController as AjaxDashboardController;
use App\Http\Controllers\Web\Ajax\LocationController as AjaxLocationController;

Route::middleware(['noAuth'])->group(function(){
    Route::get('admin', [AuthController::class, 'index'])->name('auth.login');
    Route::post('signin', [AuthController::class, 'signin'])->name('auth.signin');    
});

Route::middleware(['auth'])->group(function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('signout', [AuthController::class, 'signout'])->name('auth.signout');
    Route::get('users/profile', [UserController::class, 'profile'])->name('users.profile');
    Route::patch('users/{id}/profile/update', [UserController::class, 'updateProfile'])->name('users.profile.update');

    Route::middleware(['permission'])->group(function(){

        Route::get('user_catalogues/{id}/delete', [UserCatalogueController::class, 'delete'])->name('user_catalogues.delete');
        Route::resource('user_catalogues', UserCatalogueController::class);

        Route::get('users/{id}/resetPassword', [UserController::class, 'resetPassword'])->name('users.resetPassword');
        Route::post('users/{id}/updatePassword', [UserController::class, 'updatePassword'])->name('users.updatePassword');
        Route::get('users/{id}/delete', [UserController::class, 'delete'])->name('users.delete');
        Route::resource('users', UserController::class);

        Route::get('permissions/{id}/delete', [PermissionController::class, 'delete'])->name('permissions.delete');
        Route::resource('permissions', PermissionController::class);

        Route::get('teams/{id}/delete', [TeamController::class, 'delete'])->name('teams.delete');
        Route::resource('teams', TeamController::class);

        Route::get('vehicles/{id}/delete', [VehicleController::class, 'delete'])->name('vehicles.delete');
        Route::resource('vehicles', VehicleController::class);

        Route::get('passengers/{id}/delete', [PassengerController::class, 'delete'])->name('passengers.delete');
        Route::resource('passengers', PassengerController::class);

        Route::get('cargos/{id}/delete', [CargoController::class, 'delete'])->name('cargos.delete');
        Route::resource('cargos', CargoController::class);

        Route::get('risks/{id}/delete', [RiskController::class, 'delete'])->name('risks.delete');
        Route::resource('risks', RiskController::class);

        Route::get('taxes/{id}/delete', [TaxController::class, 'delete'])->name('taxes.delete');
        Route::resource('taxes', TaxController::class);

        Route::get('consultations/{id}/delete', [ConsultationController::class, 'delete'])->name('consultations.delete');
        Route::resource('consultations', ConsultationController::class);

        Route::get('checks/{id}/delete', [CheckController::class, 'delete'])->name('checks.delete');
        Route::resource('checks', CheckController::class);

        Route::get('digitals/{id}/delete', [DigitalController::class, 'delete'])->name('digitals.delete');
        Route::resource('digitals', DigitalController::class);

        Route::get('others/{id}/delete', [OtherController::class, 'delete'])->name('others.delete');
        Route::resource('others', OtherController::class);

        Route::get('violations/{id}/delete', [ViolationController::class, 'delete'])->name('violations.delete');
        Route::resource('violations', ViolationController::class);

        Route::get('merchandises/{id}/delete', [MerchandiseController::class, 'delete'])->name('merchandises.delete');
        Route::resource('merchandises', MerchandiseController::class);

        Route::get('units/{id}/delete', [UnitController::class, 'delete'])->name('units.delete');
        Route::resource('units', UnitController::class);
 
    });

    /*Ajax*/
    
    Route::post('ajax/dashboard/changeStatus', [AjaxDashboardController::class, 'changeStatus'])->name('ajax.dashboard.changeStatus');
    Route::get('ajax/location/getLocation', [AjaxLocationController::class, 'getLocation'])->name('ajax.location.index');
   
});
