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
Route::get('classroom',[ClassroomsController::class, 'index']);
Route::get('classroom/create',[ClassroomsController::class, 'create']);
Route::get('classroom/{classroom}/show',[ClassroomsController::class, 'show'])->where('classroom','\d+');
Route::get('classroom/{classroom}/edit',[ClassroomsController::class, 'edit'])->where('classroom','[0-9]+');
