@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="/kriteria3/mahasiswa_reguler">
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
            @elseif (Request::segment(4) === 'edit')
            Edit data
            @endif

            Mahasiswa Reguler
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
            action="{{isset($item->id) ?  route('mahasiswa_reguler.update', ['id' => Crypt::encryptString($item->id)])  : route('mahasiswa_reguler.store')}}"
            method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif

              @csrf
              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th  style="font-weight:bold;" rowspan="2">Tahun Akademik</th>
                      <th style="font-weight:bold;" rowspan="2">Daya Tampung</th>
                      <th style="font-weight:bold;" colspan="2">Jumlah Calon Mahasiswa Reguler</th>
                      <th style="font-weight:bold;" rowspan="2">Jumlah Mahasiswa Baru Reguler</th>
                      <th style="font-weight:bold;" rowspan="2">Jumlah Total Mahasiswa Reguler</th>
                      <th style="font-weight:bold;" rowspan="2">Bukti/Tautan</th>
                    </tr>
                    <tr>
                      <th style="font-weight:bold;">Pendaftar</th>
                      <th style="font-weight:bold;">Lulus Seleksi</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                    <tr>
                      <td><input type="text" class="form-control @error('tahun_akademik') is-invalid @enderror" name="tahun_akademik" value="{{isset($item->tahun_akademik) ? $item->tahun_akademik : old('tahun_akademik')}}" placeholder="ketik disini" autofocus>                      </td>
                      <td><input type="text" class="form-control @error('daya_tampung') is-invalid @enderror" name="daya_tampung" value="{{isset($item->daya_tampung) ? $item->daya_tampung : old('daya_tampung')}}" placeholder="ketik disini">                      </td>
                      <td><input type="text" class="form-control @error('pendaftar') is-invalid @enderror" name="pendaftar" value="{{isset($item->pendaftar) ? $item->pendaftar : old('pendaftar')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control @error('lulus_seleksi') is-invalid @enderror" name="lulus_seleksi" value="{{isset($item->lulus_seleksi) ? $item->lulus_seleksi : old('lulus_seleksi')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control @error('jum_mahasiswa_baru') is-invalid @enderror" name="jum_mahasiswa_baru" value="{{isset($item->jum_mahasiswa_baru) ? $item->jum_mahasiswa_baru : old('jum_mahasiswa_baru')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control @error('total') is-invalid @enderror" name="total" value="{{isset($item->total) ? $item->total : old('total')}}" placeholder="ketik disini"></td>
                      <td><input type="text" class="form-control" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini"></td>
                    </tr>
                  </tbody>

                </table>
              </div>

                    @if (Request::segment(3) === 'create')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data Mahasiswa Reguler </button>
                    @elseif (Request::segment(4) === 'edit')
                    <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Update data Mahasiswa Reguler  </button>
                    @endif

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- last row starts here -->

        </div>
        @endsection
