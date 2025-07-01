<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\CountCasesController;
use App\Http\Controllers\AddClientController;
use App\Http\Controllers\FetchClientsController;
use App\Http\Controllers\FetchUsers;
use App\Http\Controllers\RequestResetController;
use App\Http\Controllers\ResetPasswordController;



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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});


// Register route
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cases', [CasesController::class, 'index']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/count-cases', [CountCasesController::class, 'index']);
Route::middleware('auth:sanctum')->get('/case-percentage', [CountCasesController::class, 'index']);
Route::middleware('auth:sanctum')->post('/add-client', [AddClientController::class, 'addClient']);
Route::middleware('auth:sanctum')->get('/clients', [FetchClientsController::class, 'index']);
Route::middleware('auth:sanctum')->get('/fetch-users', [FetchUsers::class, 'fetcusers']);
Route::middleware('auth:sanctum')->get('/fetch-user-by-id', [FetchUsers::class, 'fetch_user_by_id']);
Route::middleware('auth:sanctum')->post('/send-reset-link', [RequestResetController::class, 'sendResetLink']);
Route::middleware('auth:sanctum')->post('/reset-password', [ResetPasswordController::class, 'reset']);



