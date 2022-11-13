<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\EventTypeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/', EventController::class)
    ->only(['index'])
    ->middleware(['guest']);

Route::resource('events', EventController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'show', 'destroy'])
    ->middleware(['auth', 'verified']);

Route::resource('eventtypes', EventTypeController::class)
    ->only(['index', 'store', 'edit', 'update', 'destroy'])
    ->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
