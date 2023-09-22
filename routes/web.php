<?php

use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomsController;
use App\Http\Controllers\ClassworkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinClassroomsController;
use App\Http\Controllers\TopicsController;

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
    
    // Route::get('classrooms',[ClassroomsController::class, 'index'])->name('classrooms.index');
    // Route::get('classrooms/create',[ClassroomsController::class, 'create'])->name('classrooms.create');
    // Route::post('classrooms',[ClassroomsController::class, 'store'])->name('classrooms.store');
    // Route::get('classrooms/{classroom:code}/show',[ClassroomsController::class, 'show'])->name('classrooms.show')->where('classroom','\d+');
    // Route::get('classrooms/{classroom:code}/edit',[ClassroomsController::class, 'edit'])->name('classrooms.edit')->where('classroom','[0-9]+');
    // Route::put('classrooms/{classroom:code}/update',[ClassroomsController::class, 'update'])->name('classrooms.update')->where('classroom','[0-9]+');
// Route::delete('classrooms/{classroom:code}/delete',[ClassroomsController::class, 'delete'])->name('classrooms.delete')->where('classroom','[0-9]+');
Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware'=>'auth', 'prefix'=> 'topics/trashed', 'as' => 'topics.', 'controller'=> TopicsController::class], function() {
    Route::get('/', 'trashed')->name('trashed');
    Route::put('/{classroom}', 'restore')->name('restore');
    Route::delete('/{classroom}', 'forceDelete')->name('forec-delete');
    
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('classrooms/{classroom}/join', [JoinClassroomsController::class, 'create'])->name('classrooms.join');
    Route::post('classrooms/{classroom}/join', [JoinClassroomsController::class, 'store']);
    Route::get('classrooms/{classroom}/people',[ClassroomPeopleController::class,'index'])->name('classrooms.people');
    Route::delete('classrooms/{classroom}/people',[ClassroomPeopleController::class,'destroy'])->name('classrooms.people.destroy');
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::resource('classrooms', ClassroomsController::class);
    Route::resource('classroom.topics', TopicsController::class);
    Route::resource('classroom.classworks', ClassworkController::class)->shallow();
    
});

require __DIR__.'/auth.php';
