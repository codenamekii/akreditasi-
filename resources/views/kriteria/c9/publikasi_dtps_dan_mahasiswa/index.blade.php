@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')
      <a href="{{route('publikasi_dtps_dan_mahasiswa.create')}}">
        <button class="btn btn-outline-primary mb-2 mb-md-0 mr-2"> Tambah data </button>
      </a>
      @endif
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif LED</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.9 Publikasi DTPS Dan Mahasiswa</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Publikasi DTPS Dan Mahasiswa</h5>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          @endif
          @if(session('info'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{ session('info') }} Silakan <a href="/dashboard">klik disini.</a>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          @endif
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2">Jenis Publikasi</th>
                  <th colspan="3">Jumlah Judul</th>
                  <th rowspan="2">Jumlah</th>
                  <th rowspan="2">Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>TS-2</th>
                  <th>TS-1</th>
                  <th>TS</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$item->jenis}} </td>
                  <td>{{$item->jumlah_ts_2}}</td>
                  <td>{{$item->jumlah_ts_1}}</td>
                  <td>{{$item->jumlah_ts}}</td>
                  <td>{{$item->jumlah_ts_2 + $item->jumlah_ts_1 + $item->jumlah_ts }}</td>
                  <td><a href="{{ $item->tautan }}" target="_blank" >Lihat</a></td>

                  <td>
                    @if(Auth::user()->role == 'admin prodi')

                    <a href="{{route('publikasi_dtps_dan_mahasiswa.edit', ['id'=>$item->id] )}}" class="btn btn-primary btn-sm" type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i> </a>
                    <a href="{{route('publikasi_dtps_dan_mahasiswa.destroy', ['id'=>$item->id] )}}"  onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i>  </a>
                    @endif
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
