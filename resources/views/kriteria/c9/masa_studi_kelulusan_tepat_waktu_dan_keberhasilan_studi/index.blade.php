@extends('template')

@section('css')
  <style>

  </style>
@endsection

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')
      <a href="{{route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.create')}}">
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
          <p class="m-0">K.9 Masa Studi, Kelulusan Tepat Waktu, dan Keberhasilan </p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Masa Studi, Kelulusan Tepat Waktu, dan Keberhasilan </h5>
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
                  <th rowspan="2">Tahun masuk</th>
                  <th rowspan="2">Jumlah Mahasiswa Diterima</th>
                  <th colspan="7">Jumlah Mahasiswa yang Lulus pada … </th>
                  <th rowspan="2">Jumlah Lulusan sd Akhir TS</th>
                  <th rowspan="2">Rata-Rata Masa Studi</th>
                  <th rowspan="2">Tautan</th>
                  <th rowspan="2">Aksi</th>
                </tr>
                <tr>
                  <th>Akhir TS-6</th>
                  <th>Akhir TS-5</th>
                  <th>Akhir TS-4</th>
                  <th>Akhir TS-3</th>
                  <th>Akhir TS-2</th>
                  <th>Akhir TS-1</th>
                  <th>Akhir TS</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $item)
                @php
                $total = $item->jumlah_lulus_ts_6 + $item->jumlah_lulus_ts_5 + $item->jumlah_lulus_ts_4 + $item->jumlah_lulus_ts_3 + $item->jumlah_lulus_ts_2 + $item->jumlah_lulus_ts_1 + $item->jumlah_lulus_ts;
                $avg = $total / 7;
                @endphp
                <tr>
                  <td>{{ $item->tahun_masuk }}</td>
                  <td>{{ $item->jumlah_diterima }}</td>
                  <td>{{ $item->jumlah_lulus_ts_6 }}</td>
                  <td>{{ $item->jumlah_lulus_ts_5 }}</td>
                  <td>{{ $item->jumlah_lulus_ts_4 }}</td>
                  <td>{{ $item->jumlah_lulus_ts_3 }}</td>
                  <td>{{ $item->jumlah_lulus_ts_2 }}</td>
                  <td>{{ $item->jumlah_lulus_ts_1 }}</td>
                  <td>{{ $item->jumlah_lulus_ts }}</td>
                  <td>{{ $total }}</td>
                  <td>{{ $avg }}</td>
                  <td>{!! $item->tautan ? '<a href="' . $item->tautan . '" target="_blank">Link</a>' : 'Tidak ada tautan' !!}</td>
                  <td>
                    @if(Auth::user()->role == 'admin prodi')

                    <a href="{{route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.edit', ['id' => $item->id])}}" type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></a>
                    <form action="{{ route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.destroy', ['id' => $item->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </button>
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
