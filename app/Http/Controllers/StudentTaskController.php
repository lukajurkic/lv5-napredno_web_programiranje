<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class StudentTaskController extends Controller
{
    public function index()
    {
        // Prikaži sve radove
        $tasks = Task::with('user')->get(); // uz info o nastavniku
        return view('student.tasks.index', compact('tasks'));
    }
}
