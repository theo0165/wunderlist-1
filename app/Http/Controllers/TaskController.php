<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use DateTime;

class TaskController extends Controller
{
    public function request(Request $request)
    {
        //This is when entering 'edittask'-page.
        if ($request->has('task_id')) {
            $taskid = $request->input('task_id');
            $task = Task::where('user_id', auth()->id())->where('id', $taskid)->first()->toArray();
            $task['back_url'] = $request['back_url'];

            //Make a join with list table and find which list that belongs to to this task.
            //Add the name of it to task, just for display in the form. The list_id is already saved.

            $lists = TaskList::all()->toArray();

            return view("edittask", ['task' => $task, 'lists' => $lists]);
        }

        if ($request->input('request') === 'createfromlist') {
            dd("Yo!");
        }

        switch ($request->input('request')) {
            case 'store': //This is when pushing 'done' on 'createtask'-page
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
            case 'update': //This is when pushing 'done' on 'edittask'-page
                $isCompleted = false;
                if ($request->has('completed')) {
                    $isCompleted = true;
                }
                Task::where('id', $request->input('id')) //Is this safe, could you change the id in the browser and change other's tasks?
                    ->update([
                        'title' => $request->input('title'),
                        'description' => $request->input('description'),
                        'deadline' => $request->input('deadline'),
                        'list_id' => $request->input('listid'),
                        'completed' => $isCompleted
                    ]);
                return redirect()->to($request->input('back_url'));
            case 'delete': //This is when pushing delete on 'edittask'-page.
                Task::where('id', $request->input('id'))->delete();
                return redirect()->to($request->input('back_url'));
        }
    }

    public function loadTasksInTasks()
    {
        $tasks = Task::where('user_id', auth()->id())->get()->toArray();
        $tasks = sortTaskeByDateTime($tasks);
        return view("tasks", ['tasks' => $tasks]);
    }

    public function loadTasksInList()
    {
        $tasks = DB::table('tasks')
            ->where('tasks.user_id', auth()->id())
            ->join('task_lists', 'tasks.list_id', '=', 'task_lists.id')
            ->get()->toArray();
        $tasks = sortTaskeByDateTime($tasks);
        return view("list", ['tasks' => $tasks]);
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
