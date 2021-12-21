<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function GuzzleHttp\Promise\all;

class TaskController extends Controller
{

    public function create()
    {
        return view('task');
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
    }
}
