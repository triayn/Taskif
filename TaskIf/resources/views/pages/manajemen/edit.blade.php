@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Edit Tugas</h2>
    <form action="{{ route('manajemen.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $task->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="menunggu" {{ $task->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="proses" {{ $task->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $task->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="due_date" class="form-label">Batas Waktu</label>
            <input type="datetime-local" name="due_date" class="form-control" value="{{ old('due_date', \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i')) }}" required>
        </div>
        
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('manajemen.list') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
