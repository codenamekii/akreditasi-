@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
    <div class="page-header flex-wrap">
        <div class="header-left">
            <a href="{{ route('dosen.create') }}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Tambah dosen</a>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Master data</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Dosen</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Master data dosen</h5>
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
                                    <th>NIDN / NUPTK</th>
                                    <th>Nama</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Sertifikat Pendidikan</th>
                                    <th>Jabatan fungsional</th>
                                    <th>Gelar Akademik</th>
                                    <th>Pendidikan</th>
                                    <th>Bidang Keahlian</th>
                                    <th>Sesuai PS</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dosen as $user)
                                <tr>
                                    <td>{{ $user->nidn_nidk }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->tanggal_lahir }}</td>
                                    <td>{{ $user->sertifikat_pendidik }}</td>
                                    <td>{{ $user->jabatan_fungsional }}</td>
                                    <td>{{ $user->gelar_akademik }}</td>
                                    <td>{{ $user->pendidikan }}</td>
                                    <td>{{ $user->bidang_keahlian }}</td>
                                    <td>{{ $user->sesuai_ps }}</td>
                                    <td>
                                        @if(empty($user->tautan))
                                            <p class="text-danger">tautan belum di input</p>
                                        @else
                                            <a href="{{ $user->tautan }}" target="_blank" class="btn btn-primary btn-sm">Lihat</a>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('dosen.edit',$user->id) }}"class="btn btn-sm btn-primary"><i class="mdi mdi-table-edit" ></i></a>

                                        <form action="{{ route('dosen.delete',$user->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit"  class="btn btn-sm btn-danger" onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?')"><i class="mdi mdi-delete"></i</button>
                                        </form>
                                    </td>
                                </tr>
                                </tr>
                                </tr>
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
