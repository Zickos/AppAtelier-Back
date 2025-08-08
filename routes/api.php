<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\Api\{
    VehicleController,
    VehicleSocieteController,
    TypeVehicleController,
    TypeTravailController,
    UserController,
    RoleController,
    RetrofitController,
    PlanningController,
    DemandeController,
    PhotoController,
    AuthController
};

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->get('/indexUsers', [UserController::class, 'indexUsers']);
Route::middleware('auth:sanctum')->get('/indexMecanicien', [UserController::class, 'indexMecanicien']);
Route::middleware('auth:sanctum')->get('/indexMagasinier', [UserController::class, 'indexMagasinier']);
Route::middleware('auth:sanctum')->get('/indexMecano', [PlanningController::class, 'indexMecano']);
Route::middleware('auth:sanctum')->get('/indexMagasin', [PlanningController::class, 'indexMagasin']);

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'vehicles'      => VehicleController::class,
        'vehiclessociete'      => VehicleSocieteController::class,
        'retrofits'     => RetrofitController::class,
        'typevehicles'  => TypeVehicleController::class,
        'typetravails'  => TypeTravailController::class,
        'users'         => UserController::class,
        'roles'         => RoleController::class,
        'plannings'     => PlanningController::class,
        'demandes'      => DemandeController::class,
        'photos'        => PhotoController::class,
    ]);
});

Route::options('/{any}', function () {
    return response()->noContent();
})->where('any', '.*');

/* Route::apiResources([
        'users'         => UserController::class,
    ]); */