@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
    <a href="/kriteria2/bidang_pkm/create/bidang pkm">
      <button class="btn btn-outline-primary mb-2 mb-md-0 mr-2"> Tambah data </button>
    </a>
    @endif
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">C.2 Tata Pamong, Tata Kelola, dan Kerjasama</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Data Kerja Sama - Bidang Pengabdian Kepada Masyarakat (PkM)</h5>
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
                  <th rowspan="2">Nama Lembaga Mitra</th>
                  <th colspan="3">Tingkat</th>
                  <th rowspan="2">Judul dan Ruang Lingkup Kerjasama</th>
                  <th rowspan="2">Manfaat/Output</th>
                  <th rowspan="2">Durasi</th>
                  <th rowspan="2">Bukti/Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Internasional</th>
                  <th>Nasional</th>
                  <th>Lokal</th>
                </tr>
              </thead>
              <tbody class="text-justify">
                @php $jum_inter = 0; $jum_nasional = 0; $jum_lokal = 0; @endphp
                @foreach($items as $item)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{$item->nama_mitra}}</td>
                  <td> @if($item->tingkat == "Internasional") <b>V</b> @php $jum_inter += 1 @endphp  @endif </td>
                  <td> @if($item->tingkat == "Nasional") <b>V</b> @php $jum_nasional += 1 @endphp  @endif </td>
                  <td> @if($item->tingkat == "Lokal") <b>V</b> @php $jum_lokal += 1 @endphp @endif </td>
                  <td>{{$item->judul_ruang_lingkup}}</td>
                  <td>{{$item->manfaat_output}}</td>
                  <td>{{$item->durasi}}</td>
                  <td>
                      <a href="{{$item->tautan}}">
                      <button type="button" class="btn btn-outline-success btn-sm"><i class="mdi mdi-link"></i></button>
                    </a>
                  </td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>
                    <a href="/kriteria2/bidang_pkm/{{$item->id}}/edit/bidang pkm">
                    <button type="button" class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i></button>
                  </a>
                    <a type="button" href="/kriteria2/bidang_pkm/{{$item->id}}/delete/" onclick="confirm('Apakah anda yakin untuk menghapus data ini ?')" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </a>
                  </td>
                  @endif
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th colspan="2">Jumlah</th>
                  <th>{{$jum_inter}}</th>
                  <th>{{$jum_nasional}}</th>
                  <th>{{$jum_lokal}}</th>
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
