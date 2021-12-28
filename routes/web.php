<?php

use App\Http\Controllers\LogInUserController;
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



Route::get(
    '/',
    function () {
        return view('login');
    }
);



Route::get('/signup', [RegisterUserController::class, 'create']);
Route::post('/', [RegisterUserController::class, 'store']);

Route::get('/profile', [TaskController::class, 'loadToday']);
Route::post('/profile', LogInUserController::class);

Route::get('/tasks', [TaskController::class, 'loadTasksInTasks'])->name('tasks');

Route::post('/edittask', [TaskController::class, 'request']);

Route::view('/createtask', 'createtask');
Route::post('/createtask', [TaskController::class, 'request']);

Route::post('/list', [TaskController::class, 'loadTasksInList'])->name('list');

Route::get('/lists', [TaskListController::class, 'loadLists'])->name('lists');
Route::post('/lists', [TaskListController::class, 'createList']);
