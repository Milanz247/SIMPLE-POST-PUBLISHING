<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;


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
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('signout', [HomeController::class, 'signOut'])->name('signout');

Route::get('/dashboard', [UserController::class, 'viewdashboard'])->name('dashboard');
Route::post('/savepost', [UserController::class, 'Savepost'])->name('savepost');
Route::get('/post/remove/{id}', [UserController::class, 'Remove'])->name('remove');
Route::get('fetch-post', [UserController::class, 'fetchpost']);
Route::get('/posts/{id}/edit', [UserController::class, 'EditPost'])->name('post.edit');
Route::post('/updatepost', [UserController::class, 'UpdatePost'])->name('updatepost');







