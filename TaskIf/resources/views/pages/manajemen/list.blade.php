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
                        <li><a class="dropdown-item" href="#">Hapus</a></li>
                    </ul>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body">
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
                        <button type="submit" class="btn bg-ungu text-white">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane show active" id="state-saving-preview">
                            <a href="#" class="btn btn-primary btn-sm" style="margin-bottom: 1.5em;">
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
                                    @foreach ($data as $row)
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
                                            <a href="#" class="btn btn-info"><i class="fas fa-fw fa-eye"></i> </a>
                                            <a href="#" class="btn btn-success">
                                                <i class="fas fa-fw fa-pen"></i>
                                            </a>
                                            <!-- Button Hapus dengan Modal -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#">
                                                <i class="fas fa-fw fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div> <!-- end tab-content-->
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
@endsection