<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskListController extends Controller
{

    public function load()
    {
        $lists = TaskList::where('user_id', auth()->id())->get()->toArray();
        return view("lists", ['lists' => $lists]);
    }

    public function create(Request $request)
    {
        $list = new TaskList();
        $list->user_id = auth()->id();
        $list->title = $request->input('title');
        $list->save();
        return redirect()->route("lists");
    }

    public function delete(Request $request)
    {
        Task::where('list_id', $request->input('list_id'))->delete();
        TaskList::where('id', $request->input('list_id'))->delete();

        return redirect()->route('lists');
    }
}
