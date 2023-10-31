<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InvoiceGeneratorController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserSettingsController;
use App\Http\Controllers\Api\CustomerController;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('/users', UserController::class);
    Route::apiResource('/invoices', InvoiceGeneratorController::class);
    Route::apiResource('/settings', UserSettingsController::class);
    Route::apiResource('customers', CustomerController::class);

    // Route::post('user-settings', [UserSettingsController::class, 'store']);
    // Route::put('user-settings/{userSettings}', [UserSettingsController::class, 'update']);
    // Route::get('user-settings/{userSettings}', [UserSettingsController::class, 'show']);

});

Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);
