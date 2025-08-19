@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manajemen Tugas</h1>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        <div>{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Alert Error --}}
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <div>{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="col-lg-4 mb-4 ms-auto">
        <div class="card shadow">
            <!-- Card Header -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between bg-ungu">
                <h6 class="m-0 font-weight-bold text-white">Kategori</h6>
                <div class="dropdown no-arrow">
                    <a class="dropdown-toggle text-white" href="#" role="button" id="dropdownMenuLink"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow animated--fade-in"
                        aria-labelledby="dropdownMenuLink">
                        <li>
                            <h6 class="dropdown-header">Aksi</h6>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalTambahKategori">
                                Tambah
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalHapusKategori">
                                Hapus
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
                @if ($category->isEmpty())
                <p class="text-muted text-center">
                    <i class="fas fa-info-circle me-1"></i>
                    Tambahkan kategori untuk membuat tugas
                </p>
                @else
                <table id="state-saving-rowtable" class="table table-striped activate-select dt-responsive nowrap w-100">
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach ($category as $kategori)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $kategori->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kategori -->
    <div class="modal fade" id="modalTambahKategori" tabindex="-1" aria-labelledby="modalTambahKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('category.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-ungu text-white">
                        <h5 class="modal-title" id="modalTambahKategoriLabel">Tambah Kategori</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="namaKategori" class="form-label">Nama Kategori</label>
                            <input type="text" class="form-control" id="namaKategori" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success text-white">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Hapus Kategori -->
    <div class="modal fade" id="modalHapusKategori" tabindex="-1" aria-labelledby="modalHapusKategoriLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('category.destroy') }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-ungu text-white">
                        <h5 class="modal-title">Hapus Kategori</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kategoriHapus" class="form-label">Pilih Kategori</label>
                            <select class="form-select" id="kategoriHapus" name="id" required>
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                @foreach ($category as $kategori)
                                <option value="{{ $kategori->id }}">{{ $kategori->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-danger"><small>Data yang dihapus tidak dapat dikembalikan!</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabel Data Tugas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="state-saving-preview">
                            <a href="{{ route('manajemen.create') }}" class="btn btn-primary btn-sm" style="margin-bottom: 1.5em;">
                                <i class="fas fa-fw fa-plus"></i> Tambah Tugas
                            </a>
                            <table id="state-saving-rowtable" class="table table-striped activate-select dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Deadline</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 1; @endphp
                                    @forelse ($data as $row)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $row->due_date }}</td>
                                        <td>{{ $row->title }}</td>
                                        <td>
                                            @if(strtolower($row->status) == 'menunggu')
                                            <span class="badge bg-primary text-white">{{ $row->status }}</span>
                                            @elseif(strtolower($row->status) == 'proses')
                                            <span class="badge bg-warning text-white">{{ $row->status }}</span>
                                            @elseif(strtolower($row->status) == 'selesai')
                                            <span class="badge bg-success text-white">{{ $row->status }}</span>
                                            @else
                                            <span class="badge bg-secondary text-white">{{ $row->status }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('manajemen.show', $row->id) }}" class="btn btn-info">
                                                <i class="fas fa-fw fa-eye"></i>
                                            </a>
                                            <a href="{{ route('manajemen.edit', $row->id) }}" class="btn btn-success">
                                                <i class="fas fa-fw fa-pen"></i>
                                            </a>
                                            <!-- Button Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalHapusTugas{{ $row->id }}">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-ungu fw-bold">
                                            <i class="fas fa-info-circle me-1"></i> Belum ada data tugas
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- Modal Hapus Tugas -->
    <div class="modal fade" id="modalHapusTugas{{ $row->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('manajemen.destroy', $row->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus tugas <strong>{{ $row->title }}</strong>?
                        <p class="text-danger mt-2"><small>Data yang dihapus tidak dapat dikembalikan.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection