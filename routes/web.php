<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use App\Models\TaskList;
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


//Login
Route::view('/', 'login')->name('login');
Route::post('/', [AuthUserController::class, 'login']);

//Signup
Route::get('/signup', [RegisterUserController::class, 'create']);
Route::post('/signup', [RegisterUserController::class, 'store']);

Route::group(['middleware' => ['auth']], function () {
    //Profile
    Route::get('/profile', [TaskController::class, 'loadToday'])->name('profile');
    Route::post('/profile', [AuthUserController::class, 'logout']);

    //Tasks
    Route::get('/tasks', [TaskController::class, 'loadTasksInTasks'])->name('tasks');

    //Edit task
    Route::get('/edittask', [TaskController::class, 'load']);
    Route::put('/edittask', [TaskController::class, 'update']);
    Route::delete('edittask', [TaskController::class, 'delete']);

    //Create task
    Route::view('/createtask', 'createtask');
    Route::post('/createtask', [TaskController::class, 'store']);

    //List
    Route::get('/list', [TaskController::class, 'loadTasksInList'])->name('list');

    //Lists
    Route::get('/lists', [TaskListController::class, 'load'])->name('lists');
    Route::post('/lists', [TaskListController::class, 'create']);

    //Settings
    Route::view('/settings', 'settings');
});
