@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
        <div class="header-left">
            <a href="{{ route('matakuliah.create') }}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Tambah data matakuliah</a>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Master data</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Matakuliah</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Master data Matakuliah</h5>
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible flex-grow-1 mr-3 mb-3" role="alert">
                        <div class="d-flex w-100">
                            <div class="mr-auto">{{ session('success') }}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif

                    
                    @if (session('info'))
                    <div class="alert alert-info alert-dismissible flex-grow-1 mr-3 mb-3" role="alert">
                        <div class="d-flex w-100">
                            <div class="mr-auto">{{session('info')}}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if (session('info'))
                    <div class="alert alert-info alert-dismissible flex-grow-1 mr-3 mb-3" role="alert">
                        <div class="d-flex w-100">
                            <div class="mr-auto">{{session('info')}}</div>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif

                    <p class="mb-2">
                       <!-- keterangan disini -->
                    </p>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Kode MK</th>
                                    <th>Nama</th>
                                    <th>SKS</th>
                                    <th>Semester</th>
                                    <th>Jenis Matakuliah</th>
                                    <th>Kesesuaian CPL</th>
                                    <th>Perangkat Pembelajaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataMatakuliah as $data)
                                <tr>
                                    <td>{{ $data->kode_mk }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->sks }}</td>
                                    <td>{{ $data->semester }}</td>
                                    <td>{{ $data->jenis_matakuliah }}</td>
                                    <td>{{ $data->kesesuaian_cpl }}</td>
                                    <td>{{ $data->perangkat_pembelajaran }}</td>
                                    <td>
                                        <a href="{{ route('matakuliah.edit',$data->kode_mk) }}" class="btn btn-warning btn-sm">Edit</a>

                                        <form action="{{ route('matakuliah.delete',$data->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                @endforeach

                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function confirmDelete(url) {
        if (confirm('Apakah anda yakin ingin menghapus akun ini?')) {
            window.location.href = url;
        }
    }
</script>
