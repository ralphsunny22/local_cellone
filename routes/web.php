<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [PermissionController::class, 'test'])->name('test');
Route::post('/', [PermissionController::class, 'testPost'])->name('testPost');
Route::get('/testuser', [PermissionController::class, 'testuser'])->name('testuser');
Route::post('/testuser', [PermissionController::class, 'testuserPost'])->name('testuserPost');

Route::get('/add-perms-to-role', [PermissionController::class, 'addPermsToRole'])->name('addPermsToRole');
Route::get('/add-role-and-perms-to-user', [PermissionController::class, 'addRoleAndPermsToUser'])->name('addRoleAndPermsToUser');
Route::get('/user-can', [PermissionController::class, 'userCan'])->name('userCan');
Route::get('/remove-role-perms', [PermissionController::class, 'removeRolePerm'])->name('removeRolePerm');
Route::get('/alter-user-perms', [PermissionController::class, 'alterPerm'])->name('alterPerm');
