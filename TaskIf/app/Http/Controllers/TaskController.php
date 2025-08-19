<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\task as ModelsTask;
use App\Models\TaskNote;
use Illuminate\Console\View\Components\Task;
use Illuminate\Contracts\Database\ModelIdentifier;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
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

        $data = ModelsTask::where('user_id', $userId)->whereIn('status', ['menunggu', 'proses'])->get();
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

    public function show($id)
    {
        $task = ModelsTask::with('category')->findOrFail($id);
        $notes = ModelsTask::with('notes')->findOrFail($id);

        return view('pages.manajemen.show', compact('task', 'notes'));
    }

    public function edit($id)
    {
        $task = ModelsTask::findOrFail($id);

        return view('pages.manajemen.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'due_date' => 'required|date',
        ]);

        $task = ModelsTask::findOrFail($id);
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('manajemen.list')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $task = ModelsTask::findOrFail($id);
            $task->delete();

            return redirect()->route('manajemen.list')->with('success', 'Tugas "' . $task->title . '" berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('manajemen.list')->with('error', 'Gagal menghapus tugas.');
        }
    }
}
