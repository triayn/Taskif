@extends('layouts.main')

@section('content')
<div class="container mt-3">
    <div class="row">

        @php
        $warnaKartu = ['bg-ungu', 'bg-hijau', 'bg-biru', 'bg-kuning', 'bg-merah', 'bg-hitam'];
        @endphp

        @foreach ($data as $index => $task)
        <div class="col-lg-3 mb-3">
            <div class="card shadow">
                <a class="card-header py-3 {{ $warnaKartu[$index % count($warnaKartu)] }}"
                    data-toggle="collapse" href="#task{{ $task->id }}" role="button">
                    <h6 class="m-0 font-weight-bold text-white">{{ $task->title }}</h6>
                </a>
                <div class="collapse show" id="task{{ $task->id }}">
                    <div class="card-body">
                        <p><strong>Status:</strong>
                            @if(strtolower($task->status) == 'menunggu')
                            <span class="badge bg-primary text-white">{{ $task->status }}</span>
                            @elseif(strtolower($task->status) == 'proses')
                            <span class="badge bg-warning text-white">{{ $task->status }}</span>
                            @elseif(strtolower($task->status) == 'selesai')
                            <span class="badge bg-success text-white">{{ $task->status }}</span>
                            @else
                            <span class="badge bg-secondary text-white">{{ $task->status }}</span>
                            @endif
                        </p>
                        <p><strong>Deadline:</strong> {{ $task->due_date }}</p>
                        <hr>
                        <p><strong>Catatan:</strong></p>
                        <ul>
                            @php
                            $taskNotes = $note->where('task_id', $task->id);
                            @endphp

                            @forelse ($taskNotes as $n)
                            <li><small>{{ $n->created_at->format('d-m-Y') }}</small>: {{ $n->note }}</li>
                            @empty
                            <li><em>Belum ada catatan</em></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>
</div>
@endsection