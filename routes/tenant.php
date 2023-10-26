<?php

declare(strict_types=1);

use App\Http\Controllers\Tenant\OrdersController;
use App\Http\Controllers\Tenant\ProductsController;
use App\Http\Controllers\Tenant\UsersController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::apiResource('/users', UsersController::class)
        ->only('index', 'store', 'show');

    Route::apiResource('/products', ProductsController::class)
        ->only('index', 'store', 'show');

    Route::apiResource('/orders', OrdersController::class)
        ->only('index', 'store', 'show');
});
