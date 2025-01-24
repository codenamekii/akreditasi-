@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="/kriteria6/mata_kuliah_cpl_dan_perangkat_pembelajaran/create">
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
          <p class="m-0">K.6 Tabel Mata Kuliah, CPL, Dan Perangkat Pembelajaran</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Mata Kuliah, CPL, Dan Perangkat Pembelajaran</h5>
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
                  <th rowspan="2">Semester</th>
                  <th rowspan="2">Kode MK</th>
                  <th rowspan="2">Nama Mata Kuliah</th>
                  <th colspan="3">Jenis</th>
                  <th rowspan="2">SKS</th>
                  <th colspan="3">Unit Penyelenggara*</th>
                  <th rowspan="2">Kesesuaian CPL</th>
                  <th rowspan="2">Perangkat Pembelajaran</th>
                  <th rowspan="2">Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Teori</th>
                  <th>Praktikum</th>
                  <th>Praktik</th>
                  <th>PT</th>
                  <th>UPPS</th>
                  <th>PS</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $item->semester }}</td>
                  <td>{{ $item->kode_mk }}</td>
                  <td>{{ $item->nama }}</td>
                  <td>{{ (isset($item->jenis_matakuliah) && $item->jenis_matakuliah == 'teori') ? 'V' : '' }}</td>
                  <td>{{ (isset($item->jenis_matakuliah) && $item->jenis_matakuliah == 'praktikum') ? 'V' : '' }}</td>
                  <td>{{ (isset($item->jenis_matakuliah) && $item->jenis_matakuliah == 'praktik') ? 'V' : '' }}</td>
                  <td>{{ $item->sks }}</td>
                  <td>{{ (isset($item->unit_penyelenggara) && $item->unit_penyelenggara == 'pt') ? 'V' : '' }}</td>
                  <td>{{ (isset($item->unit_penyelenggara) && $item->unit_penyelenggara == 'upps') ? 'V' : '' }}</td>
                  <td>{{ (isset($item->unit_penyelenggara) && $item->unit_penyelenggara == 'ps') ? 'V' : '' }}</td>
                  <td>{{ $item->kesesuaian_cpl }}</td>
                  <td>{{ $item->perangkat_pembelajaran }}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria6/mata_kuliah_cpl_dan_perangkat_pembelajaran/{{ $item->id }}/edit" class="btn btn-outline-primary"> <i class="mdi mdi-table-edit" ></i></a>
                    <a href="/kriteria6/mata_kuliah_cpl_dan_perangkat_pembelajaran/{{$item->id}}/delete" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>
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
