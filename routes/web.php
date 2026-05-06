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
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\ResultController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return view('authentication.login');
});

Route::get('/auth/google/redirect', [SocialController::class, 'googleRedirect'])
    ->name('google.redirect');

Route::get('/auth/google/callback', [SocialController::class, 'googleCallback'])
    ->name('google.callback');

Route::get('/auth/github/redirect', [SocialController::class, 'githubRedirect'])
    ->name('github.redirect');

Route::get('/auth/github/callback', [SocialController::class, 'githubCallback'])
    ->name('github.callback');

Route::post('login', [loginController::class, 'login'])->name('login');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

Route::post('/login', [loginController::class, 'login'])->name('login');

Route::middleware('auth')->group(function () {

    Route::get('/tests', [TestController::class, 'index']);
    Route::get('/user/{id}/signature', [ProfileController::class, 'getSignature']);
    Route::post('/user/{id}/signature', [ProfileController::class, 'addSignature']);
    Route::delete('/user/{id}/signature', [ProfileController::class, 'deleteSignature']);
    Route::put('/user/{id}/email', [ProfileController::class, 'updateEmail']);
    Route::put('/user/{id}/password', [ProfileController::class, 'updatePassword']);




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




Route::middleware(['auth', 'check.role:admin'])->group(function () {
    Route::view('/AdminDashboard', 'admin.dashboard')
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
        Route::get('/users/{role}', 'users')->name('users.role');
        Route::get('/deletedusers', 'deletedUsers')->name('users.deleted');
        Route::post('/adduser', 'adduser')->name('users.add');
        Route::get('/user/{id}', 'show')->name('users.show');
        Route::put('/edit/{id}', 'edit')->name('users.edit');
        Route::delete('/delete/{id}', 'delete')->name('users.delete');
        Route::post('/restoreuser/{id}', 'restoreUser')->name('users.restore');
        Route::delete('/forcedeleteuser/{id}', 'forceDelete')->name('users.forceDelete');
    });
    Route::prefix('inventory')->controller(InventoryManagement::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/trashed', 'trashed');
        Route::get('/alerts', 'alerts');
        Route::get('/search/{search}', 'search');
        Route::get('/export-pdf', 'exportStockasPdf');
        Route::get('/{id}', 'show');
        Route::get('/{id}/logs', 'showLogs');
        Route::post('/add', 'add');
        Route::put('/{id}/edit', 'edit');
        Route::put('/{id}/add-stock', 'addStock');
        Route::put('/{id}/deduct-stock', 'deductStock');
        Route::delete('/{id}', 'deleteItem');
        Route::post('/{id}/restore', 'restoreItem');
        Route::delete('/{id}/force', 'forceDeleteItem');
    });
    Route::get('/stats/monthly', [StatisticsController::class, 'fetchMonthlyDetails']);
    Route::post('/stats/search', [StatisticsController::class, 'Search']);
});

Route::middleware(['auth', 'check.role:receptionist'])->group(function () {
    Route::view('/receptionist', 'receptionist.receptionst')->name('receptionist');
    Route::get('/orders', [OrderController::class, 'getOrders']);
    Route::get('/orders/{trackingId}/receipt/pdf', [OrderController::class, 'downloadReceiptPdf']);
    Route::post('/orders', [OrderController::class, 'CreateOrder']);
    Route::delete('/orders/{id}', [OrderController::class, 'delete']);
    Route::get('/orders/search/{search}', [OrderController::class, 'SearchOrder']);
    Route::get('/orders/{trackingId}/summary', [OrderController::class, 'showSummary']);
    Route::get('/stats', [StatisticsController::class, 'fetchDailyStats']);
    Route::post('/search', [StatisticsController::class, 'SearchForReceptionist']);
});
Route::middleware(['auth', 'check.role:samplecollector'])->group(function () {
    Route::view('/SampleCollector', 'SampleCollector.dashboard')->name('samplecollector.dashboard');
    Route::get('/PendingOrders', [SampleCollectorController::class, 'index'])->name('PendingOrders');
    Route::post('/CollectSample', [SampleCollectorController::class, 'CollectSample'])->name('CollectSample');
});
Route::middleware(['auth', 'check.role:technician'])->group(function () {
    Route::view('/Technician', 'Technician.SampleBasedTechnician')->name('SampleBasedTechnician');
    Route::get('/TechnicianStats', [TechnicianController::class, 'getDashboardStats']);
    Route::post('/ReceiveSample', [TechnicianController::class, 'Lock']);
    Route::post('/getSampleInfo', [TechnicianController::class, 'getSampleInfo']);
    Route::get('/TechnicianWorklist', [TechnicianController::class, 'TechnicianWorklist']);
    Route::get('/getPendingVerifications', [TechnicianController::class, 'getPendingVerificationList']);
    Route::view('/TechnicianDashboard', 'Technician.HumanBasedTechnician')->name('HumanTechnicianDashboard');
    Route::get('/HumanTechnicianStats', [TechnicianController::class, 'getHumanDashboardStats']);
    Route::get('/HumanTechnicianPendingWorklist', [TechnicianController::class, 'HumanTechnicianPendingWorklist']);
    Route::post('/StartHumanTest', [TechnicianController::class, 'StartHumanTest']);
    Route::post('/uploadHumanResultFile', [TechnicianController::class, 'uploadHumanResultFile']);
});
Route::middleware(['auth', 'check.role:pathologist'])->group(function () {
    Route::get('/pathologist', function () {
        return view('pathologist.dashboard');
    })->name('pathologist.dashboard');
    Route::get('/getPathologistStats', [ResultController::class, 'getPathologistStats']);
    Route::get('/getPathologistPendingList', [ResultController::class, 'getPendingResultList']);
    Route::get('/getPathologistCompletedReports', [ResultController::class, 'getCompletedReports']);
    Route::get('/deprtmentTests', [TestController::class, 'deprtmentTests']);
    Route::get('/InventoryItems', [TestController::class, 'inventoryItems']);
    Route::get('/tests/trashed', [TestController::class, 'trashedIndex']);
    Route::post('/tests/add', [TestController::class, 'add']);
    Route::put('/tests/{id}', [TestController::class, 'update']);
    Route::delete('/tests/{id}', [TestController::class, 'destroy']);
    Route::post('/tests/{id}/restore', [TestController::class, 'restore']);
});

Route::get('/tests/{id}', [TestController::class, 'show']);










Route::post('/addResult', [ResultController::class, 'addResult']);
Route::get('/getPendingResultList', [ResultController::class, 'getPendingResultList']);
Route::get('/getResultsByOrderTestId/{id}', [ResultController::class, 'getResultsByOrderTestId']);
    Route::post('/verifyResult', [ResultController::class, 'verifyResult']);
    Route::post('/rejectSample', [ResultController::class, 'rejectSample']);
Route::get('/getPathologistStats', [ResultController::class, 'getPathologistStats']);
Route::get('/getCompletedReports', [ResultController::class, 'getCompletedReports']);




Route::get('/orders/{trackingId}/test/{testId}/report', [OrderController::class, 'downloadReport']);
Route::get('/public/track-report/{trackingId}', [OrderController::class, 'PublicTrackReport']);

Route::get('/whoami', fn() => auth()->user());

Route::get('/getOrderTestParameters/{id}', [TechnicianController::class, 'getOrderTestParameters']);
