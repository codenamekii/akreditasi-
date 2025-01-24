@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="/kriteria3/mahasiswa_dalam_negeri/create">
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
          <p class="m-0">K.3 Mahasiswa</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Calon Mahasiswa Dalam Negeri</h5>
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
                  <th rowspan="2">Tahun Akademik</th>
                  <th rowspan="2">Jumlah Provinsi</th>
                  <th colspan="2">Jumlah Calon Mahasiswa Reguler</th>
                  <th rowspan="2">Total Mahasiswa Reguler</th>
                  <th rowspan="2">Bukti/Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Laki-laki</th>
                  <th>Perempuan</th>
                </tr>
              </thead>
              <tbody class="text-center">
                @php $total_mhs =0; @endphp
                @foreach($items as $item)
                @php 
                  $tahun_sekarang = date('Y');
                  $selisih = $tahun_sekarang - $item->tahun_akademik; 
                  $ta = ($selisih == 0) ? 'TS' : 'TS-' . $selisih;
                  
                  $total_mhs += $item->laki_laki + $item->perempuan;
                @endphp
                <tr>
                  <td>{{$ta}}</td>
                  <td>{{$item->jumlah_provinsi}}</td>
                  <td>{{$item->laki_laki}}</td>
                  <td>{{$item->perempuan}}</td>
                  <td>{{$item->laki_laki + $item->perempuan}}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria3/mahasiswa_dalam_negeri/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="/kriteria3/mahasiswa_dalam_negeri/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
              <tfoot  class="text-center">
                <tr>
                  <th>Jumlah</th>
                  <th>{{$total[0]}}</th>
                  <th>{{$total[1]}}</th>
                  <th>{{$total[2]}}</th>
                  <th>{{$total_mhs}}</th>
                </tr>
              </tfoot>

            </table>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- last row starts here -->

</div>
@endsection
