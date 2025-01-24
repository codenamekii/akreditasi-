@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria6/integrasi_hasil_penelitian_dan_pkM_dalam_proses_pembelajaran">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="{{route('kriteria6')}}">
          <p class="m-0">K.6 Integrasi Penelitian dan PKM dalam Pembelajaran</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('integrasi_pembelajaran.update', ['id' => Crypt::encryptString($item->id)])  : route('integrasi_pembelajaran.store')}}" method="post">
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

            Integrasi Penelitian dan PKM
          </h4>

          <p class="card-description">K.6 Integrasi Penelitian dan PKM dalam Pembelajaran</p>
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
  <label class="col-sm-3 col-form-label">Judul Penelitian/PKM</label>
  <div class="col-sm-9">
    <input type="text" name="judul" value="{{ old('judul', isset($item->judul) ? $item->judul : '') }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Ketik disini">
    @error('judul')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Dosen</label>
  <div class="col-sm-9">
    <select class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk">
      <option value="">Pilih</option>
      @foreach($dosens as $dosen)
      <option value="{{ $dosen->nidn_nidk }}" 
        @if(old('nidn_nidk', isset($item->nidn_nidk) ? $item->nidn_nidk : '') == $dosen->nidn_nidk) selected @endif>
      {{ $dosen->nama }}</option>
      @endforeach
    </select>
    @error('nidn_nidk')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Matakuliah</label>
  <div class="col-sm-9">
    <select class="form-control @error('mk_id') is-invalid @enderror" name="mk_id">
      <option value="">Pilih</option>
      @foreach($matakuliah as $mk)
      <option value="{{ $mk->kode_mk }}" 
        @if(old('mk_id', isset($item->mk_id) ? $item->mk_id : '') == $mk->kode_mk) selected @endif>
      {{ $mk->nama }}</option>
      @endforeach
    </select>
    @error('mk_id')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="form-group row">
  <label class="col-sm-3 col-form-label">Bentuk Integrasi</label>
  <div class="col-sm-9">
    <input type="text" name="bentuk_integrasi" value="{{ old('bentuk_integrasi', isset($item->bentuk_integrasi) ? $item->bentuk_integrasi : '') }}" class="form-control @error('bentuk_integrasi') is-invalid @enderror" placeholder="Ketik disini">
    @error('bentuk_integrasi')
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

