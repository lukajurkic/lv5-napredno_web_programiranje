<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Application;

class TeacherApplicationController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['applications.student'])
            ->where('user_id', auth()->id())
            ->get();

        return view('teacher.applications.index', compact('tasks'));
    }

    public function accept(Application $application)
    {
        // provjera da li nastavnik može prihvatiti prijavu samo na svoj rad
        if ($application->task->user_id !== auth()->id()) {
            abort(403, 'Access denied');
        }

        // označi sve prijave na isti rad kao pending osim prihvaćene
        $application->task->applications()->update(['status' => 'pending']);

        // prihvati odabranu prijavu
        $application->status = 'accepted';
        $application->save();

        return redirect()->back()->with('success', 'Student prihvaćen.');
    }
}
