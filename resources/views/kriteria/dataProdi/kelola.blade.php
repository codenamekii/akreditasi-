@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">

    <a href="{{ route('dataprodi.create') }}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Tambah program studi</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Menu Akun</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Kelola program studi</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data program studi</h5>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th>Kode program studi</th>
                  <th>Nama program studi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_prodi as $prodi)
                  <tr>
                    <td>{{$prodi->id}}</td>
                    <td>{{$prodi->nama}}</td>
                    <td>
                      <a href="{{route('dataprodi.editById', Crypt::encryptString($prodi->id) )}}" class="btn btn-sm btn-primary"><i class="mdi mdi-table-edit" ></i></a>
                      <form action="{{ route('dataprodi.delete', Crypt::encryptString($prodi->id) )}}" method="post" class="d-inline" onsubmit="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus data"><i class="fa fa-trash"></i></button>
                      </form>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- last row starts here -->

</div>
@endsection
