<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->tasks()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        auth()->user()->tasks()->create([
            'title' => $request->title
        ]);

        return redirect()->back();
    }

    public function update($id)
    {
        $task = auth()->user()->tasks()->findOrFail($id);

        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        auth()->user()->tasks()->findOrFail($id)->delete();
        return redirect()->back();
    }
}
