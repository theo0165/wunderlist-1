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
    public function request(Request $request)
    {
        if ($request->has('task_id')) { //Load the form with task_id
            $taskid = $request->input('task_id');
            $task = Task::where('user_id', auth()->id())->where('id', $taskid)->get()->toArray();
            $task[0]['back_url'] = $request['back_url'];
            return view("edittask", ['task' => $task[0]]);
        }

        switch ($request->input('request')) {
            case 'store':
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
                return redirect()->route("tasks");
            case 'update':
                $isCompleted = false;
                if ($request->has('completed')) {
                    $isCompleted = true;
                }
                Task::where('id', $request->input('id')) //Is this safe, could you change the id in the browser and change other's tasks?
                    ->update([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'deadline' => $request->input('deadline'),
                        'list_id' => $request->input('list_id'),
                        'completed' => $isCompleted
                    ]);
                return redirect()->to($request->input('back_url'));
            case 'delete':
                Task::where('id', $request->input('id'))->delete();
                return redirect()->to($request->input('back_url'));
        }
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
        return view(request()->path(), ['tasks' => $tasks]);
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
