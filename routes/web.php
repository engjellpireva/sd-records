<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logs', [App\Http\Controllers\LogController::class, 'index'])->middleware(['auth', 'role:Administrator|Supervisor']);
Route::get('/logs/search', [App\Http\Controllers\LogController::class, 'search'])->middleware(['auth', 'role:Administrator|Supervisor']);
Route::get('/changelog', [App\Http\Controllers\ChangeLogController::class, 'index'])->middleware('auth');
Route::post('/changelog/add', [App\Http\Controllers\ChangeLogController::class, 'add'])->middleware(['auth', 'role:Administrator']);
Route::get('/warrants/mine', [App\Http\Controllers\HomeController::class, 'myWarrants'])->middleware('auth');

Route::get('/warrants/arrest/create', [App\Http\Controllers\ArrestWarrantController::class, 'show'])->middleware('auth');
Route::get('/warrants/arrest/open', [App\Http\Controllers\ArrestWarrantController::class, 'activeWarrants'])->middleware('auth');
Route::get('/warrants/arrest/pending', [App\Http\Controllers\ArrestWarrantController::class, 'pendingWarrants'])->middleware('auth');
Route::get('/warrants/arrest/closed', [App\Http\Controllers\ArrestWarrantController::class, 'closedWarrants'])->middleware('auth');
Route::get('/warrants/arrest/details/{id}', [App\Http\Controllers\ArrestWarrantController::class, 'warrantDetails'])->middleware('auth');

Route::post('/warrants/arrest/create', [App\Http\Controllers\ArrestWarrantController::class, 'create'])->middleware('auth');
Route::post('/warrants/arrest/details/close/{id}', [App\Http\Controllers\ArrestWarrantController::class, 'warrantClose'])->middleware('auth');
Route::post('/warrants/arrest/details/approve/{id}', [App\Http\Controllers\ArrestWarrantController::class, 'warrantApprove'])->middleware('auth');
Route::post('/warrants/arrest/comments/add/{id}', [App\Http\Controllers\ArrestCommentController::class, 'add'])->middleware('auth');

Route::post('/warrants/search/create', [App\Http\Controllers\SearchWarrantController::class, 'create'])->middleware('auth');
Route::post('/warrants/search/details/close/{id}', [App\Http\Controllers\SearchWarrantController::class, 'warrantClose'])->middleware('auth');
Route::post('/warrants/search/details/approve/{id}', [App\Http\Controllers\SearchWarrantController::class, 'warrantApprove'])->middleware('auth');
Route::post('/warrants/search/comments/add/{id}', [App\Http\Controllers\SearchCommentController::class, 'add'])->middleware('auth');

Route::get('/warrants/search/create', [App\Http\Controllers\SearchWarrantController::class, 'show'])->middleware('auth');
Route::get('/warrants/search/open', [App\Http\Controllers\SearchWarrantController::class, 'activeWarrants'])->middleware('auth');
Route::get('/warrants/search/pending', [App\Http\Controllers\SearchWarrantController::class, 'pendingWarrants'])->middleware('auth');
Route::get('/warrants/search/closed', [App\Http\Controllers\SearchWarrantController::class, 'closedWarrants'])->middleware('auth');
Route::get('/warrants/search/details/{id}', [App\Http\Controllers\SearchWarrantController::class, 'warrantDetails'])->middleware('auth');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->middleware(['auth', 'role:Administrator']);
Route::get('/admin/user/create', [App\Http\Controllers\AdminController::class, 'user_create'])->middleware(['auth', 'role:Administrator']);
Route::get('/admin/user/manage', [App\Http\Controllers\AdminController::class, 'user_manage'])->middleware(['auth', 'role:Administrator']);
Route::get('/admin/user/manage/{id}', [App\Http\Controllers\AdminController::class, 'user_edit'])->middleware(['auth', 'role:Administrator']);
Route::post('/admin/user/manage/{id}', [App\Http\Controllers\AdminController::class, 'user_edit_insert'])->middleware(['auth', 'role:Administrator']);
Route::delete('/admin/user/manage/delete/{id}', [App\Http\Controllers\AdminController::class, 'user_delete'])->middleware(['auth', 'role:Administrator']);

Route::post('/admin/user/create', [App\Http\Controllers\AdminController::class, 'user_create_insert'])->middleware(['auth', 'role:Administrator']);