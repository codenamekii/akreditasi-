@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="{{route('jumlah_mahasiswa_bimbingan_ta.create')}}">
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
          <p class="m-0">K.6 Jumlah Mahasiswa Bimbingan Tugas Akhir atau Skripsi dan Frekuensi Pertemuan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Jumlah Mahasiswa Bimbingan Tugas Akhir atau Skripsi dan Frekuensi Pertemuan</h5>
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
                  <th rowspan="3">No</th>
                  <th rowspan="3">Nama Dosen Pembimbing</th>
                  <th colspan="8">Banyaknya Mahasiswa Bimbingan</th>
                  <th rowspan="3">Rata-Rata Jumlah  Bimbingan <br>di semua Program</th>
                  <th rowspan="3">Rata-Rata <br>Banyaknya Pertemuan</th>
                  <th rowspan="3">Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="3">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th colspan="4">Di PS Sendiri</th>
                  <th colspan="4">Di PS Lain</th>
                </tr>
                <tr>
                  <th>TS-2</th>
                  <th>TS-1</th>
                  <th>TS</th>
                  <th>Rata-Rata</th>
                  <th>TS-2</th>
                  <th>TS-1</th>
                  <th>TS</th>
                  <th>Rata-Rata</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $item)
                  @php
                    $rata_ps_sendiri = ($item->jumlah_ps_sendiri_ts2 + $item->jumlah_ps_sendiri_ts1 + $item->jumlah_ps_sendiri_ts)/3;
                    $rata_ps_lain = ($item->jumlah_ps_lain_ts2 + $item->jumlah_ps_lain_ts1 + $item->jumlah_ps_lain_ts)/3;
                  @endphp
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->dosen->nama }}</td>
                  <td>{{ $item->jumlah_ps_sendiri_ts2 }}</td>
                  <td>{{ $item->jumlah_ps_sendiri_ts1 }}</td>
                  <td>{{ $item->jumlah_ps_sendiri_ts }}</td>
                  <td>{{ number_format($rata_ps_sendiri, 1, '.',',') }}</td>
                  <td>{{ $item->jumlah_ps_lain_ts2 }}</td>
                  <td>{{ $item->jumlah_ps_lain_ts1 }}</td>
                  <td>{{ $item->jumlah_ps_lain_ts }}</td>
                  <td>{{ number_format($rata_ps_lain, 1, '.',',') }}</td>
                  <td>{{ ($rata_ps_sendiri + $rata_ps_lain)/2 }}</td>
                  <td>{{ $item->rata_pertemuan }}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="jumlah_mahasiswa_bimbingan_ta/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="jumlah_mahasiswa_bimbingan_ta/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>
                  </td>
                  @endif
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
