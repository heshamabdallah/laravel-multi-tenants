<?php

use App\Http\Controllers\Admin\TenantsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Should be wrapped with auth middleware
Route::resource('tenants', TenantsController::class)
    ->only('index', 'store', 'show');
