<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\InventoryManagement;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\SampleCollectorController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('authentication.login');
});

Route::post('/login', [loginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {



    Route::view('/receptionist', 'receptionist.receptionst')->name('receptionist');

    Route::view('/pathologist/dashboard', 'pathologist.dashboard')
        ->name('pathologist.dashboard');


});
Route::view('/VerifyCode', 'authentication.VerifyCode')
    ->name('VerifyCode');
Route::post('/VerifyCode', [loginController::class, 'verifyCode'])->name('VerifyCode');
Route::post('resetPassword', [loginController::class, 'resetPassword'])->name('resetPassword');
Route::post('forgotpassword', [loginController::class, 'forgotPassword'])->name('forgotpassword');
Route::get('/forgetPassword', function () {
    return view('authentication.forgetPassword');
})->name('forgetPassword');
Route::get('/resetPassword', function () {
    return view('authentication.resetPassword');
})->name('resetPassword');

Route::get('/home', function () {
    return view('home');
});


Route::post('login', [loginController::class, 'login'])->name('login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');
Route::get('/users', [profileController::class, 'allusers'])->name('users');

Route::middleware(['auth', 'check.role'])->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')
        ->name('admin.adminstrator');
    Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index')->name('departments');
        Route::get('/trashed', 'trashed');
        Route::post('/', 'addDepartment')->name('departments.add');
        Route::get('/{id}', 'show')->name('departments.show');
        Route::put('/{id}', 'update')->name('departments.update');
        Route::delete('/{id}', 'delete')->name('departments.delete');
        Route::put('/{id}/restore', 'restore');
    });

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/allusers', 'allusers')->name('users.all');
        Route::get('/deletedusers', 'deletedUsers')->name('users.deleted');
        Route::post('/adduser', 'adduser')->name('users.add');
        Route::get('/user/{id}', 'show')->name('users.show');
        Route::put('/edit/{id}', 'edit')->name('users.edit');
        Route::delete('/delete/{id}', 'delete')->name('users.delete');
        Route::post('/restoreuser/{id}', 'restoreUser')->name('users.restore');
        Route::delete('/forcedeleteuser/{id}', 'forceDelete')->name('users.forceDelete');
    });

    Route::prefix('inventory')->controller(InventoryManagement::class)->group(function () {
        Route::get('/', [InventoryManagement::class, 'index']);
        Route::get('/trashed', [InventoryManagement::class, 'trashed']);
        Route::get('/alerts', [InventoryManagement::class, 'alerts']);
        Route::get('/search/{search}', [InventoryManagement::class, 'search']);
        Route::get('/history', [InventoryManagement::class, 'allHistory']);
        Route::get('/export-pdf', [InventoryManagement::class, 'exportStockasPdf']);
        Route::get('/{id}', [InventoryManagement::class, 'show']);
        Route::get('/{id}/logs', [InventoryManagement::class, 'showLogs']);
        Route::post('/add', [InventoryManagement::class, 'add']);
        Route::put('/{id}/edit', [InventoryManagement::class, 'edit']);
        Route::put('/{id}/add-stock', [InventoryManagement::class, 'addStock']);
        Route::put('/{id}/deduct-stock', [InventoryManagement::class, 'deductStock']);
        Route::delete('/{id}', [InventoryManagement::class, 'deleteItem']);
        Route::post('/{id}/restore', [InventoryManagement::class, 'restoreItem']);
        Route::delete('/{id}/force', [InventoryManagement::class, 'forceDeleteItem']);

    });


    Route::get('/stats/monthly', [StatisticsController::class, 'fetchMonthlyDetails']);
    Route::post('/stats/search', [StatisticsController::class, 'Search']);

});

Route::get('/auth/google/redirect', [SocialController::class, 'googleRedirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [SocialController::class, 'googleCallback'])
    ->name('google.callback');

Route::get('/auth/github/redirect', [SocialController::class, 'githubRedirect'])
    ->name('github.redirect');

Route::get('/auth/github/callback', [SocialController::class, 'githubCallback'])
    ->name('github.callback');
Route::middleware('auth')->group(function () {
    Route::get('/tests', [TestController::class, 'index']);
    Route::get('/tests/{id}', [TestController::class, 'show']);
    Route::post('/tests/add', [TestController::class, 'add']);
    Route::put('/tests/{id}', [TestController::class, 'update']);
    Route::delete('/tests/{id}', [TestController::class, 'destroy']);
    Route::get('/inventory', [InventoryManagement::class, 'index']);
});
Route::get('/user/{id}/signature', [ProfileController::class, 'getSignature']);
Route::post('/user/{id}/signature', [ProfileController::class, 'addSignature']);
Route::delete('/user/{id}/signature', [ProfileController::class, 'deleteSignature']);



Route::get('/tests', [TestController::class, 'index']);
Route::get('/tests/{id}', [TestController::class, 'show']);



Route::get('/orders', [OrderController::class, 'getOrders']);
Route::post('/orders', [OrderController::class, 'CreateOrder']);
Route::delete('/orders/{id}', [OrderController::class, 'delete']);
Route::get('/orders/{trackingId}/summary', [OrderController::class, 'showSummary']);
Route::get('/orders/search/{search}', [OrderController::class, 'SearchOrder']);
Route::post('/dashboard/stats', [OrderController::class, 'Search']);
Route::get('/tests', [TestController::class, 'index']);
Route::get('/tests/{id}', [TestController::class, 'show']);
Route::put('/user/{id}/email', [ProfileController::class, 'updateEmail']);
Route::put('/user/{id}/password', [ProfileController::class, 'updatePassword']);




Route::view('/dashboard', 'SampleCollector.dashboard')
    ->name('SampleCollector.dashboard');
Route::get('/PendingOrders', [SampleCollectorController::class, 'index'])->name('PendingOrders');
Route::post('/CollectSample', [SampleCollectorController::class, 'CollectSample'])->name('CollectSample');