@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')

      <a href="{{route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.create')}}">
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
          <p class="m-0">K.9  Produk atau Jasa DTPS dan Mahasiswa yang Diadopsi oleh Masyarakat</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel  Produk atau Jasa DTPS dan Mahasiswa yang Diadopsi oleh Masyarakat</h5>
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
                  <th >No</th>
                  <th >Nama Dosen dan/atau Mahasiswa</th>
                  <th >Nama Produk/Jasa</th>
                  <th >Deskripsi Produk/Jasa</th>
                  <th >Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th >Aksi</th>
                  @endif
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach ($items as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>
                    Dosen : {{ $item->dosen->nama }} <br>
                    Mahasiswa : {{ $item->nama_mahasiswa }}
                  </td>
                  <td>{{ $item->nama_produk }}</td>
                  <td>{{ $item->deskripsi }}</td>
                  <td>@if(!empty($item->tautan))<a href="{{ $item->tautan }}" target="_blank" rel="noopener noreferrer">Lihat</a>@else - @endif</td>

                  <td>
                    @if(Auth::user()->role == 'admin prodi')

                    <a href="{{ route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.edit', [$item->id]) }}">
                      <button type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i> </button>
                    </a>
                    <form action="{{ route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.destroy', [$item->id]) }}" method="POST" style="display: inline">
                      @method('DELETE')
                      @csrf
                      <button type="submit" onclick="return confirm('Apakah anda yakin untuk menghapus data ini?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </button>
                    </form>
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
