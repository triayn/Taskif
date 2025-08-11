<?php

namespace App\Http\Controllers;

use App\Models\category;
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

    public function list()
    {
        $data = ModelsTask::get();
        $category = category::get();

        return view('pages.manajemen.list', compact('data', 'category'));
    }
}
