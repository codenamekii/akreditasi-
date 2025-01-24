@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')
      <a href="{{route('ipk_lulusan.create')}}">
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
          <p class="m-0">K.9 IPK Lulusan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel IPK Lulusan</h5>
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
                  <th rowspan="2">Jumlah lulusan</th>
                  <th colspan="3">Indeks Prestasi Kumulatif (IPK)</th>
                  <th rowspan="2">Tautan</th>
                  @if(Auth::user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Minimum</th>
                  <th>Rata-Rata</th>
                  <th>Maksimum</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($data as $d)
                <tr>
                  <td>{{ $d->tahun }}</td>
                  <td>{{ $d->jumlah_lulusan }}</td>
                  <td>{{ number_format($d->minimum, 2) }}</td>
                  <td>{{ number_format($d->rata_rata, 2) }}</td>
                  <td>{{ number_format($d->maksimum, 2) }}</td>
                  <td>@if(!empty($d->tautan))<a href="{{ $d->tautan }}" target="_blank" rel="noopener noreferrer">Lihat</a>@else - @endif</td>
                  @if(Auth::user()->role == 'admin prodi')
                  <td>
                    <a href="{{ route('ipk_lulusan.edit', ['id' => $d->id]) }}" type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i> </a>
                    <a href="{{ route('ipk_lulusan.destroy', ['id' => $d->id]) }}" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?')">
                      <button type="button" class="btn btn-outline-danger btn-sm"class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </button>
                    </a>
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
