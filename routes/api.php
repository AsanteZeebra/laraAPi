<?php




use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Cases\CasesController;
use App\Http\Controllers\Controller;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});


// Register route
Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::get('/cases', [Controller::class, 'cases'])->name('cases');


