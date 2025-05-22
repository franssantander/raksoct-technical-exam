<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskCommentController extends Controller
{

    public function store(Request $request, Task $task)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $task->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Comment added.');
    }
}
