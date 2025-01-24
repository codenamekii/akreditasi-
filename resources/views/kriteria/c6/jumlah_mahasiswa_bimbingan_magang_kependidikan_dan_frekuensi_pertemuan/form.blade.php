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
          <p class="m-0">K.5 Keuangan, Sarana, dan Prasarana</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.update', ['id' => Crypt::encryptString($item->id)])  : route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.store')}}" method="post">
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
        @if(old('nidn_nidk', isset($item->nidn_nidk) ? $item->nidn_nidk : '')  == $dosen->nidn_nidk) selected @endif>
      {{ $dosen->nama }}</option>
      @endforeach
    </select>
    @error('nidn_nidk')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Jumlah Mahasiswa Bimbingan</label>
  <div class="col-sm-9">
    <input type="number" name="jumlah_bimbingan" value="{{ isset($item->jumlah_bimbingan) ? $item->jumlah_bimbingan : old('jumlah_mahasiswa_bimbingan') }}" class="form-control @error('jumlah_bimbingan') is-invalid @enderror" placeholder="Ketik disini">
    @error('jumlah_bimbingan')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Rata-Rata Banyaknya Pertemuan/ Mahasiswa/Semester</label>
  <div class="col-sm-9">
    <input type="number" name="rata_pertemuan_semester" value="{{ isset($item->rata_pertemuan_semester) ? $item->rata_pertemuan_semester : old('rata_pertemuan_semester') }}" class="form-control @error('rata_pertemuan_semester') is-invalid @enderror" placeholder="Ketik disini">
    @error('rata_pertemuan_semester')
    <div class="invalid-feedback">
      {{ $message }}
    </div>
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

