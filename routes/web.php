<?php

use App\Models\Criteria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ValueController;
use App\Http\Controllers\ProcessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AlternativeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAlternativesCriteriasMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register/store', [RegisterController::class, 'store']);
Route::post('/login/store', [LoginController::class, 'store']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('home', [DashboardController::class, 'index']);
        Route::resource('category', CategoryController::class);
        Route::resource('user', UserController::class)->except('update');
        Route::put('user/update', [UserController::class, 'update'])->name('update');

        Route::name('process.')->prefix('process/category')->group(function () {

            Route::get('data/{categories_id}', [ProcessController::class, 'index']);
            Route::get('data/{categories_id}/result', [ProcessController::class, 'result']);
            Route::get('data/{categories_id}/result/detail/{alternative_id}/alternative', [ProcessController::class, 'show']);
            Route::get('data/{categories_id}/generate', [ProcessController::class, 'generate'])->middleware('checkAlternativesCriterias');

            // Route for alternative
            Route::get('{categories_id}/alternative', [AlternativeController::class, 'index']);
            Route::get('{categories_id}/alternative/create', [AlternativeController::class, 'create']);
            Route::post('{categories_id}/alternative/store', [AlternativeController::class, 'store']);
            Route::get('{categories_id}/alternative/{alternative_id}/edit', [AlternativeController::class, 'edit']);
            Route::put('{categories_id}/alternative/update/{alternative_id}', [AlternativeController::class, 'update']);
            Route::get('{categories_id}/alternative/delete/{alternative_id}', [AlternativeController::class, 'destroy']);

            // Route for criteria
            Route::get('{categories_id}/criteria', [CriteriaController::class, 'index']);
            Route::get('{categories_id}/criteria/create', [CriteriaController::class, 'create']);
            Route::post('{categories_id}/criteria/store', [CriteriaController::class, 'store']);
            Route::get('{categories_id}/criteria/{criteria_id}/edit', [CriteriaController::class, 'edit']);
            Route::put('{categories_id}/criteria/update/{criteria_id}', [CriteriaController::class, 'update']);
            Route::get('{categories_id}/criteria/delete/{criteria_id}', [CriteriaController::class, 'destroy']);

            // Route for value
            Route::get('{categories_id}/value', [ValueController::class, 'index']);
            Route::get('{categories_id}/value/create/{alternatives_id}', [ValueController::class, 'create']);
            Route::post('{categories_id}/value/store/{alternatives_id}', [ValueController::class, 'store']);
            Route::get('{categories_id}/value/{alternative_id}/edit', [ValueController::class, 'edit']);
            Route::put('{categories_id}/value/update', [ValueController::class, 'update']);
        });
    });
});
