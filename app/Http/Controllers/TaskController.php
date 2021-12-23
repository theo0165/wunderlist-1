<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

use DateTime;

class TaskController extends Controller
{

    public function create()
    {
        return view('createtask');
    }

    public function store(Request $request)
    {

        if (!$request->has('id')) { //Store
            $task = new Task;
            $task->user_id = auth()->id();
            $task->title = $request->input('title');
            $task->description = $request->input('description');
            $task->deadline = $request->input('deadline');
            $task->list_id = $request->input('listid');
            if ($request->has('completed')) {
                $task->completed = true;
            } else {
                $task->completed = false;
            }
            $task->save();
        } else { //Update
            Task::where('id', $request->input('id'))
                ->update([
                    'title' => $request->input('title'),
                    'description' => $request->input('description'),
                    'deadline' => $request->input('deadline'),
                    'list_id' => $request->input('list_id')
                ]);

            if ($request->has('completed')) { //Must be a better way, come back to.
                Task::where('id', $request->input('id'))
                    ->update([
                        'completed' => 1
                    ]);
            } else {
                Task::where('id', $request->input('id'))
                    ->update([
                        'completed' => 0
                    ]);
            }
        }

        $tasks = Task::where('user_id', auth()->id())->get()->toArray();
        //Sort tasks by dateTime
        //https://stackoverflow.com/questions/8121241/sort-array-based-on-the-datetime-in-php
        usort($tasks, function ($a, $b) { //Couldn't make a function from this, repeating below, come back to.
            $ad = new DateTime($a['deadline']);
            $bd = new DateTime($b['deadline']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? -1 : 1;
        });
        return view("tasks", ['tasks' => $tasks]);
    }



    public function load()
    {
        $tasks = Task::where('user_id', auth()->id())->get()->toArray();
        usort($tasks, function ($a, $b) {
            $ad = new DateTime($a['deadline']);
            $bd = new DateTime($b['deadline']);

            if ($ad == $bd) {
                return 0;
            }

            return $ad < $bd ? -1 : 1;
        });
        return view("tasks", ['tasks' => $tasks]);
    }

    public function edit(Request $request)
    {
        $taskid = $request->input('task_id');
        $task = Task::where('user_id', auth()->id())->where('id', $taskid)->get()->toArray();
        return view("edittask", ['task' => $task[0]]);
    }
}
