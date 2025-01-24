@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')

      <a href="{{route('tingkat_relevansi_pekerjaan.create')}}">
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
          <p class="m-0">K.9 Tingkat Relevansi Pekerjaan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Tingkat Relevansi Pekerjaan</h5>
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
                  <th rowspan="2">Tahun Lulus</th>
                  <th rowspan="2">Jumlah Lulusan</th>
                  <th rowspan="2">Jumlah Lulusan yang Terlacak</th>
                  <th colspan="3">Jumlah Lulusan Terlacak dengan Tingkat Relevansi Bidang Kerja	</th>
                  <th rowspan="2">Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Tinggi</th>
                  <th>Sedang</th>
                  <th>Rendah</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $data)
                <tr>
                  <td>{{ $data->tahun_lulus }}</td>
                  <td>{{ $data->jumlah_lulusan }}</td>
                  <td>{{ $data->jumlah_terlacak }}</td>
                  <td>{{ $data->relevansi_tinggi }}</td>
                  <td>{{ $data->relevansi_sedang }}</td>
                  <td>{{ $data->relevansi_rendah }}</td>
                  <td>@if(!empty($data->tautan))<a href="{{ $data->tautan }}" target="_blank" rel="noopener noreferrer">Lihat</a>@else - @endif</td>

                  <td>
                    @if(Auth::user()->role == 'admin prodi')

                    <a href="{{route('tingkat_relevansi_pekerjaan.edit', ['id' => $data->id])}}" type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></a>
                    <form action="{{route('tingkat_relevansi_pekerjaan.destroy', ['id' => $data->id])}}" method="POST" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="submit" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </button>
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
