<?php

namespace App\Http\Controllers;

use App\Models\task as ModelsTask;
use App\Models\TaskNote;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $data = ModelsTask::get();
        $note = TaskNote::get();

        return view('pages.tasks', compact('data', 'note'));
    }
}
