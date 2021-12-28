<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TaskList;
use Illuminate\Http\Request;

class TaskListController extends Controller
{
    public function request(Request $request)
    {
    }

    public function loadLists()
    {
        $lists = TaskList::where('user_id', auth()->id())->get()->toArray();
        return view("lists", ['lists' => $lists]);
    }

    public function createList(Request $request)
    {
        dd($request->all());
        return redirect()->route("lists");
    }
}
