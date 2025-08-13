@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <div class="row">
        {{-- Kolom Detail Task --}}
        <div class="col-md-8 mb-3">
            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">{{ $task->title }}</h4>
                </div>
                <div class="card-body">
                    <p><strong>Kategori:</strong> {{ $task->category->name ?? '-' }}</p>
                    <p><strong>Status:</strong>
                        @if(strtolower($task->status) == 'menunggu')
                        <span class="badge bg-primary">{{ $task->status }}</span>
                        @elseif(strtolower($task->status) == 'proses')
                        <span class="badge bg-warning">{{ $task->status }}</span>
                        @elseif(strtolower($task->status) == 'selesai')
                        <span class="badge bg-success">{{ $task->status }}</span>
                        @else
                        <span class="badge bg-secondary">{{ $task->status }}</span>
                        @endif
                    </p>
                    <p><strong>Jatuh Tempo:</strong> {{ $task->due_date }}</p>
                    <hr>
                    <p><strong>Deskripsi:</strong></p>
                    <p class="text-muted">{{ $task->description }}</p>
                </div>
                <div class="card-footer text-muted">
                    Dibuat: {{ $task->created_at->format('d M Y H:i') }} |
                    Terakhir diupdate: {{ $task->updated_at->format('d M Y H:i') }}
                </div>
            </div>
        </div>

        {{-- Kolom Catatan --}}
        <div class="col-md-4 mb-3">
            <div class="card border-warning shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Catatan</h5>
                </div>
                <div class="card-body">
                    @if($task->notes && $task->notes->count() > 0)
                    @foreach($task->notes as $note)
                    <div class="mb-2 p-2 border rounded bg-light">
                        {{ $note->note }}
                        <small class="d-block text-muted">{{ $note->created_at->format('d M Y H:i') }}</small>
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted">Belum ada catatan</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection