<?php
// routes/api.php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelController;

Route::middleware(['auth'])->group(function () {
    // API Routes
    Route::get('/dashboard/data', [DashboardController::class, 'getDashboardData']);
    Route::get('/admin/activities', [DashboardController::class, 'getAdminActivities']);
    Route::get('/excel/export/activities', [ExcelController::class, 'exportAdminActivities']);
    Route::post('/excel/import/data', [ExcelController::class, 'importNavigationData']);
});