@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="/kriteria4/pengembangan_kompetensi_dtps/create">
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
          <p class="m-0">K.4 Sumber Daya Manusia</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Pengembangan Kompetensi DTPS pada TS</h5>
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
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Nama Dosen</th>
                  <th rowspan="2">Bidang Keahlian</th>
                  <th rowspan="2">Nama Kegiatan</th>
                  <th rowspan="2">Tempat</th>
                  <th rowspan="2">Waktu</th>
                  <th rowspan="2">Manfaat</th>
                  <th rowspan="2">Bukti/Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items_ts as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->dosen->nama}}</td>
                  <td>{{$item->bidang_keahlian}}</td>
                  <td>{{$item->nama_kegiatan}}</td>
                  <td>{{$item->tempat}}</td>
                  <td>{{$item->waktu}}</td>
                  <td>{{$item->manfaat}}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>

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
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Pengembangan Kompetensi DTPS pada TS-1</h5>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Nama Dosen</th>
                  <th rowspan="2">Bidang Keahlian</th>
                  <th rowspan="2">Nama Kegiatan</th>
                  <th rowspan="2">Tempat</th>
                  <th rowspan="2">Waktu</th>
                  <th rowspan="2">Manfaat</th>
                  <th rowspan="2">Bukti/Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items_ts1 as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->dosen->nama}}</td>
                  <td>{{$item->bidang_keahlian}}</td>
                  <td>{{$item->nama_kegiatan}}</td>
                  <td>{{$item->tempat}}</td>
                  <td>{{$item->waktu}}</td>
                  <td>{{$item->manfaat}}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>

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
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Pengembangan Kompetensi DTPS pada TS-2</h5>
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead class="text-center">
                <tr>
                  <th rowspan="2">No.</th>
                  <th rowspan="2">Nama Dosen</th>
                  <th rowspan="2">Bidang Keahlian</th>
                  <th rowspan="2">Nama Kegiatan</th>
                  <th rowspan="2">Tempat</th>
                  <th rowspan="2">Waktu</th>
                  <th rowspan="2">Manfaat</th>
                  <th rowspan="2">Bukti/Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
              </thead>
              <tbody class="text-center">
                @foreach($items_ts2 as $item)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$item->dosen->nama}}</td>
                  <td>{{$item->bidang_keahlian}}</td>
                  <td>{{$item->nama_kegiatan}}</td>
                  <td>{{$item->tempat}}</td>
                  <td>{{$item->waktu}}</td>
                  <td>{{$item->manfaat}}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/edit">
                      <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                    </a>
                    <a type="button" href="/kriteria4/pengembangan_kompetensi_dtps/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>

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
