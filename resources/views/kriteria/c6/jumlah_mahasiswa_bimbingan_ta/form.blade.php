@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.6 Jumlah Mahasiswa Bimbingan Tugas Akhir atau Skripsi dan Frekuensi Pertemuan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
    <form class="card forms-sample" action="{{isset($item->id) ?  route('jumlah_mahasiswa_bimbingan_ta.update', ['id' => Crypt::encryptString($item->id)])  : route('jumlah_mahasiswa_bimbingan_ta.store')}}" method="post">
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

            Jumlah Mahasiswa Bimbingan Magang Kependidikan dan Frekuensi Pertemuan</h4>

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
  <label class="col-sm-3 col-form-label">Nama Dosen Pembimbing Akademik</label>
  <div class="col-sm-9">
    <select class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk">
      <option value="">Pilih</option>
      @foreach($dosens as $dosen)
        <option value="{{ $dosen->nidn_nidk }}" 
          @if(old('nidn_nidk', isset($item->nidn_nidk) ? $item->nidn_nidk : '') == $dosen->nidn_nidk) selected @endif>
          {{ $dosen->nama }}
        </option>
      @endforeach
    </select>
    @error('nidn_nidk')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Jumlah Mahasiswa Bimbingan PS Sendiri</label>
  <div class="col-sm-9">
    <div class="row">
      <div class="col">
        <label for="jumlah_ps_sendiri_ts2">TS-2</label>
        <input type="number" id="jumlah_ps_sendiri_ts2" name="jumlah_ps_sendiri_ts2" value="{{ isset($item->jumlah_ps_sendiri_ts2) ? $item->jumlah_ps_sendiri_ts2 : old('jumlah_ps_sendiri_ts2') }}" class="form-control @error('jumlah_ps_sendiri_ts2') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_sendiri_ts2')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="jumlah_ps_sendiri_ts1">TS-1</label>
        <input type="number" id="jumlah_ps_sendiri_ts1" name="jumlah_ps_sendiri_ts1" value="{{ isset($item->jumlah_ps_sendiri_ts1) ? $item->jumlah_ps_sendiri_ts1 : old('jumlah_ps_sendiri_ts1') }}" class="form-control @error('jumlah_ps_sendiri_ts1') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_sendiri_ts1')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="jumlah_ps_sendiri_ts">TS</label>
        <input type="number" id="jumlah_ps_sendiri_ts" name="jumlah_ps_sendiri_ts" value="{{ isset($item->jumlah_ps_sendiri_ts) ? $item->jumlah_ps_sendiri_ts : old('jumlah_ps_sendiri_ts') }}" class="form-control @error('jumlah_ps_sendiri_ts') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_sendiri_ts')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Jumlah Mahasiswa Bimbingan PS Lain</label>
  <div class="col-sm-9">
    <div class="row">
      <div class="col">
        <label for="jumlah_ps_lain_ts2">TS-2</label>
        <input type="number" id="jumlah_ps_lain_ts2" name="jumlah_ps_lain_ts2" value="{{ isset($item->jumlah_ps_lain_ts2) ? $item->jumlah_ps_lain_ts2 : old('jumlah_ps_lain_ts2') }}" class="form-control @error('jumlah_ps_lain_ts2') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_lain_ts2')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="jumlah_ps_lain_ts1">TS-1</label>
        <input type="number" id="jumlah_ps_lain_ts1" name="jumlah_ps_lain_ts1" value="{{ isset($item->jumlah_ps_lain_ts1) ? $item->jumlah_ps_lain_ts1 : old('jumlah_ps_lain_ts1') }}" class="form-control @error('jumlah_ps_lain_ts1') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_lain_ts1')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="col">
        <label for="jumlah_ps_lain_ts">TS</label>
        <input type="number" id="jumlah_ps_lain_ts" name="jumlah_ps_lain_ts" value="{{ isset($item->jumlah_ps_lain_ts) ? $item->jumlah_ps_lain_ts : old('jumlah_ps_sendiri_ts') }}" class="form-control @error('jumlah_ps_lain_ts') is-invalid @enderror" placeholder="Ketik disini">
        @error('jumlah_ps_lain_ts')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
    </div>
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Rata-Rata Banyaknya Pertemuan/Mahasiswa/Semester</label>
  <div class="col-sm-9">
    <input type="number" name="rata_pertemuan" value="{{ isset($item->rata_pertemuan) ? $item->rata_pertemuan : old('rata_pertemuan') }}" class="form-control @error('rata_pertemuan') is-invalid @enderror" placeholder="Ketik disini">
    @error('rata_pertemuan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Tautan</label>
            <div class="col-sm-9">
              <input type="text" name="tautan" value="{{ isset($item->tautan) ? $item->tautan : old('tautan') }}" class="form-control" placeholder="Ketik disini">
            </div>
          </div>


          </div>

          <div class="card-footer">
            <button class="btn btn-primary" type="submit" name="button">
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

