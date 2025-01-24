@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="/kriteria5/dana_pkm/create">
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
          <p class="m-0">K.5 Keuangan, Sarana, dan Prasarana</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Dana PkM</h5>
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
                  <th rowspan="2">Judul PkM</th>
                  <th rowspan="2">Ketua Tim</th>
                  <th rowspan="2">Sumber dan jenis dana</th>
                  <th colspan="3">Jumlah Dana (dalam jutaan)</th>
                  <th rowspan="2">Rata-rata</th>
                  <th rowspan="2">Bukti/Tautan</th>
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
              <tbody class="text-center">
              @php
              $jumlah_dana_ts2 = 0;
              $jumlah_dana_ts1 = 0;
              $jumlah_dana_ts = 0;
              @endphp

                @foreach($items as $item)
                @php
                  $jumlah_dana_ts2 += $item->jumlah_dana_ts2;
                  $jumlah_dana_ts1 += $item->jumlah_dana_ts1;
                  $jumlah_dana_ts += $item->jumlah_dana_ts;
                @endphp
                <tr>
                  <td>{{ $item->judul_pkm}}</td>
                  <td>{{ $item->dosen->nama}}</td>
                  <td>{{ $item->sumber_dana}}</td>
                  <td>{{ number_format($item->jumlah_dana_ts1) }}</td>
                  <td>{{ number_format($item->jumlah_dana_ts2) }}</td>
                  <td>{{ number_format($item->jumlah_dana_ts) }}</td>
                  <td>{{ number_format(($item->jumlah_dana_ts2 + $item->jumlah_dana_ts1 + $item->jumlah_dana_ts)/3) }}</td>
                  <td>
                      <a href="{{ $item->tautan }}">
                        <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                      </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria5/dana_pkm/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="/kriteria5/dana_pkm/{{$item->id}}/delete" onclick="return confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>

                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="3">TOTAL</th>
                  <th>{{ number_format($jumlah_dana_ts2) }}</th>
                  <th>{{ number_format($jumlah_dana_ts1) }}</th>
                  <th>{{ number_format($jumlah_dana_ts) }}</th>
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
