<?php

use App\Http\Controllers\ClassroomsController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

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
// $router = App::make('router');
// $router->get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('welcome');
});
// Route::get('classrooms',[ClassroomsController::class, 'index'])->name('classrooms.index');
// Route::get('classrooms/create',[ClassroomsController::class, 'create'])->name('classrooms.create');
// Route::post('classrooms',[ClassroomsController::class, 'store'])->name('classrooms.store');
// Route::get('classrooms/{classroom:code}/show',[ClassroomsController::class, 'show'])->name('classrooms.show')->where('classroom','\d+');
// Route::get('classrooms/{classroom:code}/edit',[ClassroomsController::class, 'edit'])->name('classrooms.edit')->where('classroom','[0-9]+');
// Route::put('classrooms/{classroom:code}/update',[ClassroomsController::class, 'update'])->name('classrooms.update')->where('classroom','[0-9]+');
// Route::delete('classrooms/{classroom:code}/delete',[ClassroomsController::class, 'delete'])->name('classrooms.delete')->where('classroom','[0-9]+');
Route::resource('classrooms', ClassroomsController::class);