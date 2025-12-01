<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentApplicationController extends Controller
{
    /**
     * Student prijavljuje rad
     */
    public function apply(Request $request, Task $task)
    {
        $student = Auth::user();

        // broj već prijavljenih radova
        $count = Application::where('student_id', $student->id)->count();
        if ($count >= 5) {
            return redirect()->back()->with('error', 'Možete prijaviti maksimalno 5 radova.');
        }

        // tražimo najmanji slobodan prioritet
        $usedPriorities = Application::where('student_id', $student->id)->pluck('priority')->toArray();
        $priority = 1;
        while (in_array($priority, $usedPriorities)) {
            $priority++;
        }

        Application::create([
            'task_id' => $task->id,
            'student_id' => $student->id,
            'status' => 'pending',
            'priority' => $priority,
        ]);

        return redirect()->back()->with('success', "Rad prijavljen s prioritetom $priority.");
    }
}
