<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TeamController;

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

/*
 * General User Routes 
 */

Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


/*
 * Adimn Specific Routes 
 */
Route::group(['prefix' => 'admin'], function () {
  // Route::post('/register', [AdminController::class, 'register'])->name('admin.register');
  // Route::post('/login', [AdminController::class, 'login'])->name('admin.login');
  // Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');

  Route::group(['middleware' => ['auth:api', 'role:0']], function () {
    Route::put('/allow/{username}', [AdminController::class, 'allowUser'])->name('admin.allow');
    Route::delete('/delete/{username}', [AdminController::class, 'deleteUser'])->name('admin.delete');
  });
});


/*
 * Team Routes 
 */
Route::group(['prefix' => 'team', 'middleware' => ['auth:api', 'verified', 'role:1']], function () {
  Route::post('/team/create', [TeamController::class, 'createTeam'])->name('team.create');
  Route::delete('/team/delete/{team_name}', [TeamController::class, 'deleteTeam'])->name('team.delete');
});
