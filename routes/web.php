<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\panel\RoleController;
use App\Http\Controllers\panel\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
Route::group(['prefix' => '/panel', 'middleware' => ['auth']], function () {
  Route::get('/', [AuthController::class, 'castle'])
    ->name('castle.panel.index');
});

Route::group(['prefix' => '/panel/user',['auth','role:Admin']], function () {
  Route::get('/', [UserController::class, 'index'])
    ->name('castle.user.index');
  Route::get('/add',[UserController::class,'create'])
    ->name('castle.user.add');
  Route::post('/store',[UserController::class,'store'])
    ->name('castle.user.store');
  Route::get('/edit/{uuid}', [UserController::class, 'edit'])
    ->name('castle.user.edit');
  Route::post('/update/{uuid}', [UserController::class, 'update'])
    ->name('castle.user.update');
  Route::get('/delete/{uuid}', [UserController::class, 'destroy'])
    ->name('castle.user.delete');
  Route::post('/{user}/roles', [UserController::class, 'assignRole'])
    ->name('castle.users.roles');
  Route::delete('/{user}/roles/{role}', [UserController::class, 'removeRole'])
    ->name('castle.users.roles.remove');
  Route::post('/{user}/permissions', [UserController::class, 'givePermission'])
    ->name('castle.users.permissions');
  Route::delete('/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])
    ->name('castle.users.permissions.revoke');
  Route::get('/user/search', [UserController::class, 'search'])->name('castle.user.search');

});

Route::group(['prefix' => '/panel/roles',['auth','role:Admin']], function () {
  Route::get('/', [RoleController::class, 'index'])
    ->name('castle.role.index');
  Route::get('/add',[RoleController::class,'create'])
    ->name('castle.role.add');
  Route::post('/store',[RoleController::class,'store'])
    ->name('castle.role.store');
  Route::get('/edit/{id}', [RoleController::class, 'edit'])
    ->name('castle.role.edit');
  Route::post('/update/{id}', [RoleController::class, 'update'])
    ->name('castle.role.update');
  Route::get('/delete/{id}', [RoleController::class, 'destroy'])
    ->name('castle.role.delete');
});

