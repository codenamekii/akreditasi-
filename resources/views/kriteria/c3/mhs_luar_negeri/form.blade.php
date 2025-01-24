@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria3/mahasiswa_luar_negeri">
  <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
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
          <h4 class="card-title">
            @if (Request::segment(3) === 'create')
            Tambah data
            @elseif (Request::segment(3) === 'edit')
            Edit data
            @endif

            Mahasiswa Reguler Luar Negeri
          </h4>

            <p class="card-description">Mahasiswa</p>
            @if ($errors->any())
              <div>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li style="color: red;">{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
            @endif
            <hr>
            <form
            action="{{isset($item->id) ?  route('mahasiswa_luar_negeri.update', ['id' => Crypt::encryptString($item->id)])  : route('mahasiswa_luar_negeri.store')}}"
            method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif
              @csrf

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th rowspan="2">Tahun Akademik</th>
                      <th rowspan="2">Jumlah Negara</th>
                      <th colspan="2">Jumlah Calon Mahasiswa Reguler</th>
                      <th rowspan="2">Jumlah Total Mahasiswa Reguler</th>
                      <th rowspan="2">Bukti/Tautan</th>
                    </tr>
                    <tr>
                      <th>Laki-laki</th>
                      <th>Perempuan</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                    <tr>
                      <td><input type="text" class="form-control @error('tahun_akademik') is-invalid @enderror" name="tahun_akademik" value="{{isset($item->tahun_akademik) ? $item->tahun_akademik : old('tahun_akademik')}}" placeholder="ketik disini" autofocus>                      </td>
                      <td><input type="text" class="form-control @error('jumlah_negara') is-invalid @enderror" name="jumlah_negara" value="{{isset($item->jumlah_negara) ? $item->jumlah_negara : old('jumlah_negara')}}" placeholder="ketik disini">                      </td>
                      <td><input type="text" class="form-control @error('laki_laki') is-invalid @enderror" name="laki_laki" value="{{isset($item->laki_laki) ? $item->laki_laki : old('laki_laki')}}" placeholder="ketik disini">                      </td>
                      <td><input type="text" class="form-control @error('laki_laki') is-invalid @enderror" name="perempuan" value="{{isset($item->perempuan) ? $item->perempuan : old('perempuan')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control @error('total_mahasiswa') is-invalid @enderror" name="total_mahasiswa" value="{{isset($item->total_mahasiswa) ? $item->total_mahasiswa : old('total_mahasiswa')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini"></td>
                    </tr>
                  </tbody>

                </table>
              </div>

                    @if (Request::segment(3) === 'create')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data Calon Mahasiswa Luar negeri </button>
                    @elseif (Request::segment(4) === 'edit')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Update data Calon Mahasiswa Luar negeri </button>
                    @endif

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- last row starts here -->

        </div>
        @endsection
