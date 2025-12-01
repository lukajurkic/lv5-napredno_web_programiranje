<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_hr' => 'required|string',
            'title_en' => 'required|string',
            'description' => 'required|string',
            'study_type' => 'required|in:strucni,preddiplomski,diplomski',
        ]);

        Task::create([
            'user_id' => auth()->id(),
            'title_hr' => $request->title_hr,
            'title_en' => $request->title_en,
            'description' => $request->description,
            'study_type' => $request->study_type,
        ]);

        return redirect()->route('tasks.create')->with('success', 'Task created');
    }
}
