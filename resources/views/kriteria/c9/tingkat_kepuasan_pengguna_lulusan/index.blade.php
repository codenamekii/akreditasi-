@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(Auth::user()->role == 'admin prodi')

      <a href="{{ route('tingkat_kepuasan_pengguna_lulusan.create') }}">
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
          <p class="m-0">K.9 Tingkat Kepuasan Pengguna Lulusan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Tingkat Kepuasan Pengguna Lulusan</h5>
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
                  <th rowspan="2">Jenis Kemampuan</th>
                  <th colspan="4">Tingkat Kepuasan Pengguna (%)</th>
                  <th rowspan="2">Rencana Tindak Lanjut oleh PS dan/atau UPPS</th>
                  <th rowspan="2">Tautan</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th rowspan="2">Aksi</th>
                  @endif
                </tr>
                <tr>
                  <th>Sangat Baik</th>
                  <th>Baik</th>
                  <th>Cukup</th>
                  <th>Kurang</th>
                </tr>
              </thead>

              <tbody style="overflow-y: auto;" class="text-center" >

                @foreach($items as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->jenis_kemampuan}} </td>
                    <td>{{$item->sangat_baik}} </td>
                    <td>{{$item->baik}}</td>
                    <td>{{$item->cukup}}</td>
                    <td>{{$item->kurang}}</td>
                    <td>{{$item->tindak_lanjut}}</td>
                    <td>@if(!empty($item->tautan))<a href="{{ $item->tautan }}" target="_blank" rel="noopener noreferrer">Lihat</a>@else - @endif</td>
                    <td>
                      @if(Auth::user()->role == 'admin prodi')

                        <a href="{{route('tingkat_kepuasan_pengguna_lulusan.edit', ['id'=>$item->id] )}}"  type="button"  class="btn btn-outline-primary btn-sm"><i class="mdi mdi-table-edit" ></i> </a>
                        <form id="delete-form-{{$item->id}}" action="{{ route('tingkat_kepuasan_pengguna_lulusan.destroy', ['id'=>$item->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" onclick="confirmDelete({{$item->id}})" class="btn btn-outline-danger btn-sm"><i class="mdi mdi-delete icon" ></i> </button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach

                <script>
                    function confirmDelete(itemId) {
                        if (confirm("Are you sure you want to delete this item?")) {
                            document.getElementById('delete-form-' + itemId).submit();
                        }
                    }
                </script>


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
