@extends('layouts.main')

@section('content')
<div class="container">
    <h2>Tambah Tugas</h2>
    <form action="{{ route('manajemen.store') }}" method="POST">
        @csrf

        {{-- Pilih Kategori --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Judul Tugas --}}
        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" 
                   class="form-control" minlength="3" required
                   placeholder="Masukkan judul tugas">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" 
                      class="form-control" minlength="10" required
                      placeholder="Masukkan deskripsi tugas"></textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Due Date (Tanggal & Waktu) --}}
        <div class="mb-3">
            <label for="due_date" class="form-label">Batas Waktu</label>
            <input type="datetime-local" name="due_date" id="due_date" 
                   class="form-control" required>
            @error('due_date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status (Hidden, default "pending") --}}
        <input type="hidden" name="status" value="pending">

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-success">Simpan Tugas</button>
    </form>
</div>

{{-- Script untuk blok tanggal sebelum hari ini --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let dueDateInput = document.getElementById('due_date');
        let now = new Date();
        
        // Format: YYYY-MM-DDTHH:MM
        let year = now.getFullYear();
        let month = String(now.getMonth() + 1).padStart(2, '0');
        let day = String(now.getDate()).padStart(2, '0');
        let hour = String(now.getHours()).padStart(2, '0');
        let minute = String(now.getMinutes()).padStart(2, '0');

        let minDateTime = `${year}-${month}-${day}T${hour}:${minute}`;
        dueDateInput.min = minDateTime;
    });
</script>
@endsection
