<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\task as ModelsTask;
use App\Models\TaskNote;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $userId = Auth::id();

        $data = ModelsTask::where('user_id', $userId)->get();
        $category = category::where('user_id', $userId)->get();

        return view('pages.manajemen.list', compact('data', 'category'));
    }

    public function create()
    {
        $kategori = category::where('user_id', Auth::id())->get();

        return view('pages.manajemen.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'title'       => 'required|min:3',
            'description' => 'required|min:10',
            'due_date'    => 'required|date|after_or_equal:today'
        ]);

        try {
            $task = ModelsTask::create([
                'user_id'     => Auth::id(),
                'category_id' => $request->category_id,
                'title'       => $request->title,
                'description' => $request->description,
                'status'      => 'menunggu', // default
                'due_date'    => $request->due_date
            ]);

            if ($task) {
                return redirect()
                    ->route('manajemen.list')
                    ->with('success', 'Tugas berhasil ditambahkan.');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Gagal menambahkan tugas. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
