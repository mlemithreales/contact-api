<?php

use App\Http\Controllers\Api\V1\ContactController;
use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HealthController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/health', HealthController::class);

    Route::post('/auth/login', [AuthController::class, 'login'])
        ->middleware('throttle:login')
        ->name('auth.login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/auth/logout', [AuthController::class, 'logout'])
            ->name('auth.logout');

        Route::get('/auth/me', [AuthController::class, 'me'])
            ->name('auth.me');

        Route::get('/contacts', [ContactController::class, 'index'])
            ->name('contacts.index');

        Route::post('/contacts', [ContactController::class, 'store'])
            ->name('contacts.store');

        Route::get('/contacts/{id}', [ContactController::class, 'show'])
            ->name('contacts.show');

        Route::put('/contacts/{id}', [ContactController::class, 'update'])
            ->name('contacts.update');

        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])
            ->name('contacts.destroy');
        
        Route::patch('/contacts/{id}', [ContactController::class, 'update'])
            ->name('contacts.update.patch');
    });
});
