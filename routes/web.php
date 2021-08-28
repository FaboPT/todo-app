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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::any('/register', function(){
    return redirect('/');
});

Route::any('password', function (){
    return redirect('/');
});

Route::prefix('tasks')->middleware('auth')->group(function() {
    Route::get('',[TaskController::class,'index'])->name('task.index');
    Route::get('/create',[TaskController::class,'index'])->name('task.create');
    Route::post('',[TaskController::class,'store'])->name('task.store');
    Route::get('/{id}/edit',[TaskController::class,'edit'])->name('task.edit');
    Route::put('/{id}',[TaskController::class,'update'])->name('task.update');
    Route::delete('/{id}',[TaskController::class,'destroy'])->name('task.destroy');
});
