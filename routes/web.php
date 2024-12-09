<?php

use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\GetDataAction;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrisonerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

    Route::view('/', 'index')->name('index');



Route::middleware(['auth'])->group(function () {

    Route::middleware(['IsAdmin'])->prefix('manage')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('dashboard');

        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

        Route::resource('roles', RoleController::class)->except('show', 'edit');
        Route::get('get-roles', [RoleController::class, 'getRoles']);
        Route::get('get-abilities', [RoleController::class, 'getAbilities']);

        Route::resource('users', UserController::class)->except('show', 'edit');
        Route::get('get-users', [UserController::class, 'getUsers']);

        Route::resource('prisoners', PrisonerController::class)->except('show', 'edit');
        Route::get('get-prisoners', [PrisonerController::class, 'getPrisoners']);



//        Route::post('users', [UserController::class, 'store']);
//        Route::post('restore-user/{id}', [UserController::class, 'restoreUser']);
//        Route::delete('users/{id}', [UserController::class, 'destroy']);
//        Route::put('users/{user}', [UserController::class, 'update']);
//        Route::get('users', [UserController::class, 'index'])->name('users.index');
//        Route::get('get-users', [UserController::class, 'getUsers']);
//        Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');
        Route::get('my-account', [UserController::class, 'myAccount'])->name('my_account');
        Route::put('my-account', [UserController::class, 'updateMyAccount']);


//        Route::post('storeImage', StoreImageAction::class);


    });

});
Route::get('get-data', GetDataAction::class)->name('get_data');


require __DIR__ . '/auth.php';

