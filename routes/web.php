<?php

use App\Http\Controllers\TaskController;
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

Auth::routes();

Route::get('/', function () {
    return redirect()->route('task.index');
})->name('home');


Route::any('/register', function(){
    return redirect('/');
});

Route::any('password', function (){
    return redirect('/');
});

Route::prefix('tasks')->middleware('auth')->group(function() {
    Route::get('',[TaskController::class,'index'])->name('task.index');
    Route::post('',[TaskController::class,'store'])->name('task.store');
    Route::get('/edit/{id}',[TaskController::class,'edit'])->name('task.edit');
    Route::put('/{id}',[TaskController::class,'update'])->name('task.update');
    Route::delete('/{id}',[TaskController::class,'destroy'])->name('task.destroy');
    Route::put('/set-status/{id}',[TaskController::class,'setStatus'])->name('task.setStatus');
});
