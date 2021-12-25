<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

use DateTime;
use DateTimeZone;

class TaskController extends Controller
{

    public function create()
    {
        return view('createtask');
    }

    //This method checks a request concerning task editing and make different things depending on what the key 'request' has for a value.
    //This method gets called either on when a task should be created, updated or deleted.
    //It's called on either the tasks or list page (the form will send to the previous page and are loading the corresponding views based on the current url.
    public function request(Request $request)
    {
        if ($request->input('request') === 'store') { //Store
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
        } else if ($request->input('request') === 'update') { //Update
            Task::where('id', $request->input('id')) //Is this safe, could you change the id in the browser and change other's tasks?
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
        } else { //Delete
            Task::where('id', $request->input('id'))->delete();
        }

        $tasks = Task::where('user_id', auth()->id())->get()->toArray();
        //Sort tasks by dateTime
        $tasks = sortTaskeByDateTime($tasks);
        return view(request()->path(), ['tasks' => $tasks]);
    }



    public function load()
    {
        $tasks = Task::where('user_id', auth()->id())->get()->toArray();

        $tasks = sortTaskeByDateTime($tasks);

        return view("tasks", ['tasks' => $tasks]);
    }

    public function loadToday()
    {


        $tasks = Task::where('user_id', auth()->id())->get()->toArray();

        $tasks = array_filter($tasks, function ($task) {

            $today = new DateTime('today'); //Timezone?
            $today = $today->getTimestamp();
            $deadline = strtotime($task['deadline']);
            $timeDelta = $deadline - $today;
            if ($timeDelta < 86400 && $timeDelta >= 0) {
                return true;
            }
            return false;
        });

        $tasks = sortTaskeByDateTime($tasks);

        return view("profile", ['tasks' => $tasks]);
    }

    public function edit(Request $request)
    {
        $taskid = $request->input('task_id');
        $task = Task::where('user_id', auth()->id())->where('id', $taskid)->get()->toArray();
        return view("edittask", ['task' => $task[0]]);
    }
}

function sortTaskeByDateTime($tasks)
{
    //https://stackoverflow.com/questions/8121241/sort-array-based-on-the-datetime-in-php
    usort($tasks, function ($a, $b) {
        $ad = new DateTime($a['deadline']);
        $bd = new DateTime($b['deadline']);

        if ($ad == $bd) {
            return 0;
        }

        return $ad < $bd ? -1 : 1;
    });
    return $tasks;
}
