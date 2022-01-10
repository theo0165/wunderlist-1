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

    //This is when entering 'createtask'-page.
    public function create(Request $request)
    {
        $lists = TaskList::all()->toArray();

        $list = null; //This is the current list (When created from within a list, if not, value is null)
        $listId = $request->input('list');
        if ($listId !== null) {
            foreach ($lists as $l) {
                if ($listId = $l['id']) {
                    $list['id'] = $l['id'];
                    $list['title'] = $l['title'];
                }
            }
        }

        if ($list !== null) {
            return view("createtask", ['list' => $list, 'lists' => $lists]);
        }
        return view("createtask", ['lists' => $lists]);
    }

    public function store(Request $request)
    {
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
        return redirect()->route($request->input('back_route'), ['list_id' => $request->input('listid')]);
    }

    public function update(Request $request)
    {
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
        return redirect()->route($request->input('back_route'), ['list_id' => $request->input('listid')]);
    }

    public function delete(Request $request)
    {
        Task::where('id', $request->input('id'))->delete();
        return redirect()->route($request->input('back_route'));
    }

    //This is when entering 'edittask'-page.
    public function load(Request $request)
    {
        if ($request->has('task_id')) {
            $taskid = $request->input('task_id');
            $task = Task::where('user_id', auth()->id())->where('id', $taskid)->first()->toArray();
            $task['back_route'] = $request['back_route'];

            $currentList = TaskList::where('user_id', auth()->id())->where('id', $task['list_id'])->first();
            if ($currentList) {
                $currentList = $currentList->toArray();
                $task['list_title'] = $currentList['title'];
            }

            $lists = TaskList::all()->toArray();

            return view("edittask", ['task' => $task, 'lists' => $lists]);
        }
    }

    public function loadTasksInTasks()
    {
        $tasks = Task::where('user_id', auth()->id())->get()->toArray();
        $lists = TaskList::where('user_id', auth()->id())->get()->toArray();

        $tasks = $this->addListTitle($tasks, $lists);
        $tasks = $this->sortTaskeByDateTime($tasks);

        return view("tasks", ['tasks' => $tasks]);
    }

    public function loadTasksInList(Request $request)
    {
        $tasks = Task::where('user_id', auth()->id())->where('list_id', $request->input('list_id'))->get()->toArray();
        $list = TaskList::where('user_id', auth()->id())->where('id', $request->input('list_id'))->first()->toArray();

        $tasks = $this->sortTaskeByDateTime($tasks);

        return view("list", ['tasks' => $tasks, 'list' => $list]);
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

        $tasks = $this->sortTaskeByDateTime($tasks);
        return view(request()->path(), ['tasks' => $tasks]);
    }

    private function addListTitle($tasks, $lists)
    {
        for ($i = 0; $i < count($tasks); $i++) {
            foreach ($lists as $list) {
                $tasks[$i]['list_title'] = "";
                if ($tasks[$i]['list_id'] === $list['id']) {
                    $tasks[$i]['list_title'] = "$list[title]";
                    break;
                }
            }
        }
        return $tasks;
    }

    private function sortTaskeByDateTime($tasks)
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
}
