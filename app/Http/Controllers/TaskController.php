<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $tasks = auth()->user()->tasks();
        if ($request->status) {
           $tasks->where('status', $request->status);
        }
        if ($request->priority) {
           $tasks->where('priority', $request->priority);
        }
        if ($request->due_date) {
           $tasks->whereDate('due_date', $request->due_date);
        }
        if ($request->search) {
           $searchTerm = $request->search;
           $tasks->where(function($query) use ($searchTerm) {
                $query->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
        });
    }
        $tasks = $tasks->get();
        return view('tasks.index', compact('tasks'));

    }
    public function create()
    {
        return view('tasks.create');
    }
    public function store(TaskStoreRequest $request)
    {
        auth()->user()->tasks()->create($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task created successfully');
    }
    public function edit(Task $task)
    {
         return view('tasks.edit', compact('task'));
    }
    public function update(TaskUpdateRequest $request, Task $task)
    {
        if($task->user_id != auth()->id())
        {
            return redirect()->route('tasks.index');
        }
        $task->update($request->all());
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully');
    }
    public function destroy(Task $task)
    {
        if($task->user_id != auth()->id())
        {
            return redirect()->route('tasks.index');
        }
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully');
    }
    public function markCompleted(Task $task)
    {
        if($task->user_id != auth()->id())
        {
            return redirect()->route('tasks.index');
        }
        $task->update(['status' => 'completed']);
        return redirect()->route('tasks.index')->with('success', 'Task marked as completed');
    }
}
