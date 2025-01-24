@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{route('kegiatan_akademik_di_luar_perkuliahan.index')}}">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.6 Tabel Kegiatan Akademik di Luar Perkuliahan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('kegiatan_akademik_di_luar_perkuliahan.update', ['id' => Crypt::encryptString($item->id)])  : route('kegiatan_akademik_di_luar_perkuliahan.store')}}" method="post">
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

            Tabel Kegiatan Akademik di Luar Perkuliahan</h4>

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
  <label class="col-sm-3 col-form-label">Nama Kegiatan</label>
  <div class="col-sm-9">
    <input type="text" name="nama_kegiatan" value="{{ isset($item->nama_kegiatan) ? $item->nama_kegiatan : old('nama_kegiatan') }}" class="form-control @error('nama_kegiatan') is-invalid @enderror" placeholder="Ketik disini">
    @error('nama_kegiatan')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="form-group row">
  <label class="col-sm-3 col-form-label">Nama Dosen Pembimbing Akademik</label>
  <div class="col-sm-9">
    <select class="form-control @error('nidn_nidk') is-invalid @enderror" name="nidn_nidk">
      <option value="">Pilih</option>
      @foreach($dosens as $dosen)
        <option value="{{ $dosen->nidn_nidk }}" 
          @if(old('nidn_nidk', isset($item->nidn_nidk) ? $item->nidn_nidk : '')  == $dosen->nidn_nidk) selected @endif>
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
  <label class="col-sm-3 col-form-label">Frekuensi Kegiatan</label>
  <div class="col-sm-9">
    <select class="form-control @error('frekuensi') is-invalid @enderror" name="frekuensi">
      <option value="">Pilih</option>
      <option value="setiap bulan" 
        @if(old('frekuensi', isset($item->frekuensi) ? $item->frekuensi : '')  == 'setiap bulan') selected @endif>
        Setiap bulan
      </option>
      <option value="setiap 3 bulan" 
        @if(old('frekuensi', isset($item->frekuensi) ? $item->frekuensi : '')  == 'setiap 3 bulan') selected @endif>
        Setiap 3 bulan
      </option>
      <option value="setiap semester" 
        @if(old('frekuensi', isset($item->frekuensi) ? $item->frekuensi : '')  == 'setiap semester') selected @endif>
        Setiap semester
      </option>
    </select>
    @error('frekuensi')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>
<div class="form-group row">
  <label class="col-sm-3 col-form-label">Hasil Kegiatan</label>
  <div class="col-sm-9">
    <input type="text" name="hasil" value="{{ isset($item->hasil) ? $item->hasil : old('hasil') }}" class="form-control @error('hasil') is-invalid @enderror" placeholder="Ketik disini">
    @error('hasil')
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
  <script>
    document.getElementById('nilai2').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
    document.getElementById('nilai1').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
    document.getElementById('nilai').addEventListener('input', function (e) {
        let value = e.target.value;
        value = value.replace(/,/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        e.target.value = value;
    });
</script>

  @endsection

