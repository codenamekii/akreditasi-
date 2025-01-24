@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="/kriteria6/mata_kuliah_cpl_dan_perangkat_pembelajaran/">
        <button class="btn btn-secondary mb-2 mb-md-0 mr-2"> Kembali </button>
      </a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.6 Mata Kuliah, CPL, dan Perangkat Pembelajaran</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <form class="card forms-sample" action="{{isset($item->id) ?  route('mata_kuliah_cpl_dan_perangkat_pembelajaran.update', ['id' => Crypt::encryptString($item->id)])  : route('mata_kuliah_cpl_dan_perangkat_pembelajaran.store')}}" method="post">
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

            Mata Kuliah
          </h4>

          <p class="card-description">K.6 Mata Kuliah, CPL, dan Perangkat Pembelajaran</p>
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
    <label class="col-sm-3 col-form-label">Semester</label>
    <div class="col-sm-9">
        <select class="form-control @error('semester') is-invalid @enderror" name="semester">
            <option value="">Pilih</option>
            @for ($a = 1; $a <= 8; $a++)
                <option value="{{ $a }}" 
                  @if(old('semester', isset($item->semester) ? $item->semester : '') == $a) selected @endif>
                  {{$a}}</option>
            @endfor
        </select>
        @error('semester')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Kode Matakuliah</label>
    <div class="col-sm-9">
        <input type="text" name="kode_mk" value="{{ isset($item->kode_mk) ? $item->kode_mk : old('kode_mk') }}" class="form-control @error('kode_mk') is-invalid @enderror" placeholder="Ketik disini">
        @error('kode_mk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Nama Matakuliah</label>
    <div class="col-sm-9">
        <input type="text" name="nama" value="{{ isset($item->nama) ? $item->nama : old('nama') }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Ketik disini">
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">SKS</label>
    <div class="col-sm-9">
        <input type="number" name="sks" value="{{ isset($item->sks) ? $item->sks : old('sks') }}" class="form-control @error('sks') is-invalid @enderror" placeholder="Ketik disini">
        @error('sks')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Jenis Matakuliah</label>
    <div class="col-sm-9">
        <select class="form-control @error('jenis_matakuliah') is-invalid @enderror" name="jenis_matakuliah">
            <option value="">Pilih</option>
            <option value="teori" 
              @if(old('jenis_matakuliah', isset($item->jenis_matakuliah) ? $item->jenis_matakuliah : '') == "teori") selected @endif>
              Teori</option>
            <option value="praktikum" 
              @if(old('jenis_matakuliah', isset($item->jenis_matakuliah) ? $item->jenis_matakuliah : '') == "praktikum") selected @endif>
              Praktikum</option>
            <option value="praktik"
              @if(old('jenis_matakuliah', isset($item->jenis_matakuliah) ? $item->jenis_matakuliah : '') == "praktik") selected @endif>
              Praktik</option>              
        </select>
        @error('jenis_matakuliah')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Unit Penyelenggara</label>
    <div class="col-sm-9">
        <select class="form-control @error('unit_penyelenggara') is-invalid @enderror" name="unit_penyelenggara">
            <option value="">Pilih</option>
            <option value="pt" 
              @if(old('unit_penyelenggara', isset($item->unit_penyelenggara) ? $item->unit_penyelenggara : '') == "pt") selected @endif>
              PT</option>
            <option value="upps" 
              @if(old('unit_penyelenggara', isset($item->unit_penyelenggara) ? $item->unit_penyelenggara : '') == "upps") selected @endif>
              UPPS</option>
            <option value="ps"
              @if(old('unit_penyelenggara', isset($item->unit_penyelenggara) ? $item->unit_penyelenggara : '') == "ps") selected @endif>
              PS</option>              
        </select>
        @error('unit_penyelenggara')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Kesesuaian CPL</label>
    <div class="col-sm-9">
        <div class="form-check">
            <input type="radio" class="form-check-input @error('kesesuaian_cpl') is-invalid @enderror" name="kesesuaian_cpl" id="kesesuaian_cpl_ya" value="ya" 
                  {{ (isset($item->kesesuaian_cpl) && $item->kesesuaian_cpl == 'ya') ? 'checked' : (old('kesesuaian_cpl') == 'ya' ? 'checked' : '') }}>
            <label class="form-check-label" for="kesesuaian_cpl_ya">Ya</label>
        </div>
        <div class="form-check">
            <input type="radio" class="form-check-input @error('kesesuaian_cpl') is-invalid @enderror" name="kesesuaian_cpl" id="kesesuaian_cpl_tidak" value="tidak" 
                  {{ (isset($item->kesesuaian_cpl) && $item->kesesuaian_cpl == 'tidak') ? 'checked' : (old('kesesuaian_cpl') == 'tidak' ? 'checked' : '') }}>
            <label class="form-check-label" for="kesesuaian_cpl_tidak">Tidak</label>
        </div>
        @error('kesesuaian_cpl')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-3 col-form-label">Perangkat Pembelajaran</label>
    <div class="col-sm-9">
        <input type="text" name="perangkat_pembelajaran" value="{{ isset($item->perangkat_pembelajaran) ? $item->perangkat_pembelajaran : old('perangkat_pembelajaran') }}" class="form-control @error('perangkat_pembelajaran') is-invalid @enderror" placeholder="Ketik disini">
        @error('perangkat_pembelajaran')
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

