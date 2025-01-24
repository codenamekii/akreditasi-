@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria7/pelibatan_mahasiswa_dalam_penelitian">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.8 Pelibatan Mahasiswa dalam PKM</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('pelibatan_mahasiswa_dalam_pkm.update', ['id' => Crypt::encryptString($item->id)])  : route('pelibatan_mahasiswa_dalam_pkm.store')}}" method="post">
        @if(isset($item->id))
        @method('PUT')
        @endif
        @csrf
        <div class="card-body">
          <h4 class="card-title">
            @if (Request::segment(3) === 'create')
            Tambah data
            @elseif (Request::segment(4) === 'edit')
            Edit data
            @endif

            Data Pelibatan Mahasiswa dalam PKM
          </h4>

          <p class="card-description">K.8 Pelibatan Mahasiswa dalam PKM</p>
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

          <div class="form-group row">
    <label class="col-sm-3 col-form-label">Tahun Akademik</label>
    <div class="col-sm-9">
        <input type="number" name="tahun_akademik" value="{{ old('tahun_akademik', $item->tahun_akademik ?? '') }}" class="form-control @error('tahun_akademik') is-invalid @enderror" placeholder="Ketik disini">
        @error('tahun_akademik')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Judul</label>
    <div class="col-sm-9">
        <input type="text" name="judul" value="{{ old('judul', $item->judul ?? '') }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Ketik disini">
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Ketua Tim</label>
    <div class="col-sm-9">
        <select class="form-control @error('dosen_ketua_id') is-invalid @enderror" name="dosen_ketua_id">
            <option value="">Pilih</option>
            @foreach($dosens as $dosen)
                <option value="{{ $dosen->nidn_nidk }}"
                    @if(old('dosen_ketua_id', $item->dosen_ketua_id ?? '') == $dosen->nidn_nidk) selected @endif>
                    {{ $dosen->nidn_nidk }} | {{ $dosen->nama }}
                </option>
            @endforeach
        </select>
        @error('dosen_ketua_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Kepakaran ketua</label>
    <div class="col-sm-9">
        <input type="text" name="kepakaran_ketua" value="{{ old('kepakaran_ketua', $item->kepakaran_ketua ?? '') }}" class="form-control @error('kepakaran_ketua') is-invalid @enderror" placeholder="Ketik disini">
        @error('kepakaran_ketua')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Dosen Anggota</label>
    <div class="col-sm-9">
    <input type="text" name="dosen_anggota" value="{{ old('dosen_anggota', $item->dosen_anggota ?? '') }}" class="form-control @error('dosen_anggota') is-invalid @enderror" placeholder="Ketik disini">
        @error('dosen_anggota')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label class="col-sm-3 col-form-label">Mahasiswa</label>
    <div class="col-sm-9">
        <input type="text" name="mahasiswa" value="{{ old('mahasiswa', $item->mahasiswa ?? '') }}" class="form-control @error('mahasiswa') is-invalid @enderror" placeholder="Ketik disini">
        @error('mahasiswa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>


              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Bukti/Tautan</label>
                <div class="col-sm-9">
                  <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control" placeholder="Ketik disini">
                </div>
              </div>
            </div>

              <div class="card-footer">
                <button class="btn btn-primary" type="submit" name="button" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">
                  @if (Request::segment(3) === 'create')
                  Tambah data
                  @elseif (Request::segment(4) === 'edit')
                  Update data
                  @endif
                </button>
              </div>
            </form>
          </div>
        </div>
        <!-- last row starts here -->

      </div>

      @endsection
