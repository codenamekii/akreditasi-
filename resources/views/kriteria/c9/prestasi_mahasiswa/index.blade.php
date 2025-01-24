@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
                  @if(Auth::user()->role == 'admin prodi')

      <a href="{{route('prestasi_mahasiswa.create')}}">
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
          <p class="m-0">K.9 Prestasi Mahasiswa</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Prestasi Mahasiswa</h5>
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
                  <th rowspan="2">Nama Mahasiswa</th>
                  <th rowspan="2">Prestasi yang Dicapai</th>
                  <th rowspan="2">Waktu Pencapaian</th>
                  <th colspan="3">Tingkat</th>
                  <th rowspan="2">Tautan</th>
                  @if(Auth::user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Internasional</th>
                  <th>Nasional</th>
                  <th>Lokal</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($data as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->nama_mahasiswa }}</td>
                  <td>{{ $item->prestasi }}</td>
                  <td>{{ $item->waktu }}</td>
                  <td>{{ ($item->tingkat == 'internasional') ? 'X' : ''  }}</td>
                  <td>{{ ($item->tingkat == 'nasional') ? 'X' : ''  }}</td>
                  <td>{{ ($item->tingkat == 'lokal') ? 'X' : ''  }}</td>
                  <td>@if(!empty($item->tautan))<a href="{{ $item->tautan }}" target="_blank" rel="noopener noreferrer">Lihat</a>@else - @endif</td>

                  @if(Auth::user()->role == 'admin prodi')
                  <td>
                    <a href="{{ route('prestasi_mahasiswa.edit',['id'=>$item->id]) }}" type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></a>
                    <a href="{{ route('prestasi_mahasiswa.destroy',['id'=>$item->id]) }}" type="button" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>
                  </td>
                </tr>
                @endif
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
