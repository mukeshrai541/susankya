<?php

use App\Http\Controllers\MessageController;
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


Route::get('message', [MessageController::class, 'index'])->name('message.index');
Route::get('message/create', [MessageController::class, 'create'])->name('message.create');
Route::post('message/store', [MessageController::class, 'store'])->name('message.store');
Route::get('message/{message}/edit', [MessageController::class, 'edit'])
->name('message.edit');
// ->middleware('token_checked');
Route::put('message/{message}', [MessageController::class, 'update'])->name('message.update');
Route::get('message/{message}', [MessageController::class, 'show'])->name('message.show');
// ->middleware('token_checked');
Route::get('showMessageAuth/{message}', [MessageController::class, 'showMessageAuth'])->name('message.showMessageAuth');
Route::put('messageAuth/{message}', [MessageController::class, 'messageAuth'])->name('message.messageAuth');
Route::get('message-search', [MessageController::class, 'search'])->name('message.search');