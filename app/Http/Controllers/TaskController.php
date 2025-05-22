<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();

        $totalCreated = $user->tasks()->count();

        $totalAssigned = 0;

        $totalCompleted = $user->tasks()->where('status', 'done')->count();

        return view('dashboard', compact('totalCreated', 'totalAssigned', 'totalCompleted'));
    }



    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->withTrashed()->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'status' => 'required|in:todo,in-progress,done',
    //         'priority' => 'required|in:high,medium,low',
    //         'due_date' => 'nullable|date',
    //         'attachment' => 'nullable|file|max:2048',
    //     ]);

    //     if ($request->hasFile('attachment')) {
    //         $validated['attachment'] = $request->file('attachment')->store('attachments');
    //     }

    //     $validated['user_id'] = Auth::id();

    //     Task::create($validated);

    //     return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    // }

    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        $this->authorizeTask($task);
        return view('tasks.edit', compact('task'));
    }

    // public function update(Request $request, Task $task)
    // {
    //     $this->authorizeTask($task);

    //     $validated = $request->validate([
    //         'title' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'status' => 'required|in:todo,in-progress,done',
    //         'priority' => 'required|in:high,medium,low',
    //         'due_date' => 'nullable|date',
    //         'attachment' => 'nullable|file|max:2048',
    //     ]);

    //     if ($request->hasFile('attachment')) {
    //         if ($task->attachment) {
    //             Storage::delete($task->attachment);
    //         }
    //         $validated['attachment'] = $request->file('attachment')->store('attachments');
    //     }

    //     $task->update($validated);

    //     return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    // }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $this->authorizeTask($task);
        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function show($id)
    {
        $task = Task::withTrashed()->with('user')->findOrFail($id);

        return view('tasks.show', compact('task'));
    }


    public function destroy(Task $task)
    {
        $this->authorizeTask($task);
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task archived.');
    }

    public function restore($id)
    {
        $task = Task::withTrashed()->findOrFail($id);
        $this->authorizeTask($task);
        $task->restore();
        return redirect()->route('tasks.index')->with('success', 'Task restored.');
    }

    protected function authorizeTask(Task $task)
    {
        abort_unless($task->user_id === Auth::id(), 403);
    }

    public function filter(Request $request)
    {
        $status = $request->query('status');

        $query = auth()->user()->tasks();

        if ($status && in_array($status, ['todo', 'in-progress', 'done'])) {
            $query->where('status', $status);
        }

        $tasks = $query->orderBy('due_date')->paginate(10);

        return view('tasks.filter', compact('tasks', 'status'));
    }
}
