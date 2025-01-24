@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
<a href="{{route('dtps_ps.index')}}">
  <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
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
          <h4 class="card-title">
            @if (Request::segment(3) === 'create')
            Tambah data
            @elseif (Request::segment(4) === 'edit')
            Edit data
            @endif

            DTPS yang Bidang Keahliannya Sesuai dengan Bidang PS
          </h4>

            <p class="card-description">K.4 Sumber Daya Manusia</p>
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
            action="{{isset($item->id) ?  route('dtps_ps.update', ['id' => Crypt::encryptString($item->id)])  : route('dtps_ps.store')}}"
            method="post">
              @if(isset($item->id))
                @method('PUT')
              @endif

              @csrf

              <div class="table-responsive">
                <table class="table table-striped table-bordered">
                  <thead class="text-center">
                    <tr>
                      <th rowspan="2">Nama Lengkap</th>
                      <th rowspan="2">NIDN/NUPTK</th>
                      <th rowspan="2">Tanggal Lahir</th>
                      <th rowspan="2">Sertifikat Pendidik</th>
                      <th rowspan="2">Jabatan Fungsional</th>
                      <th rowspan="2">Gelar Akademik</th>
                      <th rowspan="2">Pendidikan <br>S1, S2, S3  dan Asal PT </th>
                      <th rowspan="2">Bidang Keahlian <br>Setiap Jenjang Pendidikan</th>
                      <th rowspan="2">Bukti/Tautan</th>
                    </tr>
                  </thead>
                  <tbody class="text-justify">

                    <tr>
    <td>
        <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{isset($item->nama) ? $item->nama : old('nama')}}" placeholder="ketik disini" autofocus>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="text" class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk" value="{{isset($item->nidn_nidk) ? $item->nidn_nidk : old('nidn_nidk')}}" placeholder="ketik disini">
        @error('nidn_nidk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{isset($item->tanggal_lahir) ? $item->tanggal_lahir : old('tanggal_lahir')}}" placeholder="ketik disini">
        @error('tanggal_lahir')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="text" class="form-control @error('sertifikat_pendidik') is-invalid @enderror" name="sertifikat_pendidik" value="{{isset($item->sertifikat_pendidik) ? $item->sertifikat_pendidik : old('sertifikat_pendidik')}}" placeholder="ketik disini">
        @error('sertifikat_pendidik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="text" class="form-control @error('jabatan_fungsional') is-invalid @enderror" name="jabatan_fungsional" value="{{isset($item->jabatan_fungsional) ? $item->jabatan_fungsional : old('jabatan_fungsional')}}" placeholder="ketik disini">
        @error('jabatan_fungsional')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="text" class="form-control @error('gelar_akademik') is-invalid @enderror" name="gelar_akademik" value="{{isset($item->gelar_akademik) ? $item->gelar_akademik : old('gelar_akademik')}}" placeholder="ketik disini">
        @error('gelar_akademik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <textarea class="form-control @error('pendidikan') is-invalid @enderror" name="pendidikan" placeholder="ketik disini" rows="8" cols="80">{{isset($item->pendidikan) ? $item->pendidikan : old('pendidikan')}}</textarea>
        @error('pendidikan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <textarea class="form-control @error('bidang_keahlian') is-invalid @enderror" name="bidang_keahlian" placeholder="ketik disini" rows="8" cols="80">{{isset($item->bidang_keahlian) ? $item->bidang_keahlian : old('bidang_keahlian')}}</textarea>
        @error('bidang_keahlian')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
    <td>
        <input type="text" class="form-control @error('tautan') is-invalid @enderror" name="tautan" value="{{isset($item->tautan) ? $item->tautan : old('tautan')}}" placeholder="ketik disini">
        @error('tautan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </td>
</tr>

                  </tbody>

                </table>
              </div>
                    @if (Request::segment(3) === 'create')
                      <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Tambah data</button>
                    @elseif (Request::segment(4) === 'edit')
                      <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';"> Update data</button>
                    @endif

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- last row starts here -->

        </div>
        @endsection
