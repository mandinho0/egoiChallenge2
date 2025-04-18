<?php

use App\Http\Controllers\Api\UserController as ApiUserController;

/**
 * APIs
 */
Route::get   ('users',        [ApiUserController::class, 'index']);
Route::get   ('users/{user}', [ApiUserController::class, 'show']);
Route::post  ('users',        [ApiUserController::class, 'store']);
Route::put   ('users/{user}', [ApiUserController::class, 'update']);
Route::delete('users/{user}', [ApiUserController::class, 'destroy']);
